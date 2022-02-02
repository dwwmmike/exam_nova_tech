<?php

class AdminPcController{
    private $adpcm;
    private $adComposant;

     public function __construct(){
        $this->adpcm = new AdminPcModel();
        $this->adComposant = new AdminComposantModel();
    }

    public function listPcs(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $pcs = $this->adpcm->getPcs($search);
        }else{
            $pcs = $this->adpcm->getPcs();
        }
       require_once("./views/admin/pc_gamer/adminPcItems.php");
    }

    public function addPc(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"])){
            $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
            $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
            $quantite = addslashes(htmlspecialchars(trim($_POST["quantite"])));
            $date = addslashes(htmlspecialchars(trim($_POST["date"])));
            $description = addslashes(htmlspecialchars(trim($_POST["description"])));
            $image = $_FILES ["image"]["name"];

            $newPc = new Pc();
            $newPc->setNom($nom);
            $newPc->setPrix($prix);
            $newPc->setQuantite($quantite);
            $newPc->setDate($date);
            $newPc->setDescription($description);
            $newPc->setImage($image);
            
            $destination = "./assets/images/";

            move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

            $pc_added = $this->adpcm->insertPc($newPc);
            if($pc_added){
                header("location:index.php?action=list_pc");
            }
        }
        require_once("./views/admin/pc_gamer/adminAddPc.php");
    }


    public function removePc(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $nbLine = $this -> adpcm -> deletePc($id);
            if($nbLine > 0){
                header("location:index.php?action=list_pc");
            }
        }
    }

    public function editPc(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $editPc = new Pc;
            $editPc->setIdPcGamer($id);

            $editPc = $this->adpcm->pcItem($editPc); 

            if(isset($_POST["soumisComposant"])) {  
                $composants = $_POST['composant'];    
                foreach($composants as $id_composant) {
                    $pcComp = new ComposantPcGamer();
                    $comp = new Composant();
                    $comp->setIdComposant($id_composant);

                    $pcComp->setComposant($comp);
                    $pcComp->setPcGamer($editPc);

                    $this->adpcm->addPcComponents($pcComp);

                } 
                
                header("location:index.php?action=edit_pc&id=".$id);
            }

            if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"])){


                $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
                $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
                $quantite = (int) addslashes(htmlspecialchars(trim($_POST["quantite"])));
                $date = addslashes(htmlspecialchars(trim($_POST["date"])));
                $description = addslashes(htmlspecialchars(trim($_POST["description"])));
                $image = $_FILES ["image"]["name"];
                
                $editPc->setNom($nom);
                $editPc->setPrix($prix);
                $editPc->setQuantite($quantite);
                $editPc->setDate($date);
                $editPc->setDescription($description);
                $editPc->setImage($image);
                
                $destination = "./assets/images/";
                move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

                $pc_updated = $this->adpcm->updatePc($editPc);
                    header("location:index.php?action=list_pc");
            }

            $composants = $this->adComposant->getComponents();
            foreach($composants as $composant) {
                $composantByType[$composant->getTypeComposant()->getNomType()][] = $composant; 
            }

            require_once("./views/admin/pc_gamer/adminEditPc.php");
        }
    }

    public function deletePcGamerComposant() 
    {
        AuthController::isLogged();
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $editPc = new Pc;
            $editPc->setIdPcGamer($id);

            if(isset($_GET["id_composant"]) && filter_var($_GET["id_composant"], FILTER_VALIDATE_INT) ){
                
                $pcComp = new ComposantPcGamer();
                $comp = new Composant();
                $comp->setIdComposant($_GET["id_composant"]);

                $pcComp->setComposant($comp);
                $pcComp->setPcGamer($editPc);

                $this->adpcm->deletePcComponents($pcComp);   

            } 
        
            header("location:index.php?action=edit_pc&id=".$id);

        }   
    }
}
?>