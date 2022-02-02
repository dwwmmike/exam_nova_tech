<?php

class AdminPcPortablesController{
    private $adpcpm;

    public function __construct(){
        $this->adpcpm = new AdminPcPortableModel();
    }

    public function listPcPortables(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $pcPortable = new PcPortable();
            $pcPortable -> setIdPcPortable($id);
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $pcps = $this->adpcpm->getPcPortables($search);
        }else{
            $pcps = $this->adpcpm->getPcPortables();
            
        }
       require_once("./views/admin/pc_portable/adminPcPortableItems.php");
    }

    public function addPcPortable(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"])){
            $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
            $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
            $quantite = addslashes(htmlspecialchars(trim($_POST["quantite"])));
            $date = addslashes(htmlspecialchars(trim($_POST["date"])));
            $description = addslashes(htmlspecialchars(trim($_POST["description"])));
            $image = $_FILES ["image"]["name"];

            $newPcp = new PcPortable();
            $newPcp->setNom($nom);
            $newPcp->setPrix($prix);
            $newPcp->setQuantite($quantite);
            $newPcp->setDate($date);
            $newPcp->setDescription($description);
            $newPcp->setImage($image);
            $destination = "./assets/images/";

            move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

            $pcp_added = $this->adpcpm->insertPcP($newPcp);
            if($pcp_added){
                header("location:index.php?action=list_pcp");
            }
        }
        require_once("./views/admin/pc_portable/adminAddPcPortable.php");
    }

    public function removePcP(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $nbLine = $this -> adpcpm ->deletePcPortable($id);
            if($nbLine > 0){
                header("location:index.php?action=list_pcp");
            }
        }
    }

    public function editPcP(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $editPortable = new PcPortable;
            $editPortable->setIdPcPortable($id);

            $editPortable = $this->adpcpm->pcPortableItem($editPortable); 
        
            if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"])){
        
                $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
                $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
                $quantite =addslashes(htmlspecialchars(trim($_POST["quantite"])));
                $date = addslashes(htmlspecialchars(trim($_POST["date"])));
                $description = addslashes(htmlspecialchars(trim($_POST["description"])));
                $image = $_FILES ["image"]["name"];        
                
                $editPortable->setNom($nom);
                $editPortable->setPrix($prix);
                $editPortable->setQuantite($quantite);
                $editPortable->setDate($date);
                $editPortable->setDescription($description);
                $editPortable->setImage($image);
                
                $destination = "./assets/images/";
                move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

                $pc_portable_updated = $this->adpcpm->updatePortable($editPortable);
                    header("location:index.php?action=list_pcp");
            }
            require_once("./views/admin/pc_portable/adminEditPcPortable.php");
        }
    }
}
?>