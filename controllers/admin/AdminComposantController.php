<?php

class AdminComposantController{

    private $adComposant;
    private $adType;

    public function __construct(){
        $this-> adComposant = new AdminComposantModel();
        $this-> adType = new AdminTypeModel();
    }

    public function listComponents(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $comp = new Composant();
            $comp -> setIdComposant($id);
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $allComps = $this->adComposant->getComponents($search);
        }else{
            $allComps = $this->adComposant->getComponents();
        }
        require_once("./views/admin/composants/adminComposantsItems.php");
    }


    public function addComp(){
        AuthController::isLogged();
        if(isset($_POST["soumis"])){
                $nom_composant = trim(htmlentities(addslashes($_POST["nom_composant"])));
                $prix= trim(htmlentities(addslashes($_POST["prix"])));
                $description = trim(htmlentities(addslashes($_POST["description"])));
                $image = $_FILES ["image"]["name"];
                $quantite = trim(htmlentities(addslashes($_POST["quantite"])));
                $id_type_composant = trim(htmlentities(addslashes($_POST["id_type_composant"])));

                $newComp = new Composant();
                $newComp->setNomComposant($nom_composant);
                $newComp->setPrix($prix);
                $newComp->setDescription($description);
                $newComp->setImage($image);
                $newComp->setQuantite($quantite);
                $newComp->getTypeComposant()->setIdTypeComposant($id_type_composant);
                $destination = "./assets/images/";
                move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

                $component_added = $this->adComposant->insertComp($newComp);
                if($component_added){
                    header("location:index.php?action=list_comp");
                }     
        }
        $tabType = $this -> adType -> getTypeComposant();

        require_once("./views/admin/composants/adminAddComposants.php");
    }


    public function removeComp(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $nbLine = $this -> adComposant -> deleteComp($id);
            if($nbLine > 0){
                header("location:index.php?action=list_comp");
            }
        }
    }
    public function editComp(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $editComp = new Composant;
            $editComp->setIdComposant($id);

            $editComp = $this->adComposant->composantItem($editComp); 
        
            if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"])){
        
                $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
                $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
                $quantite =addslashes(htmlspecialchars(trim($_POST["quantite"])));
                $description = addslashes(htmlspecialchars(trim($_POST["description"])));
                $image = $_FILES ["image"]["name"]; 

                $editComp->setNomComposant($nom);
                $editComp->setPrix($prix);
                $editComp->setQuantite($quantite);
                $editComp->setDescription($description);
                $editComp->setImage($image);
                
                
                $destination = "./assets/images/";
                move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

                $edit_comp= $this->adComposant->updateComp($editComp);
                    header("location:index.php?action=list_comp");
            }

            require_once("./views/admin/composants/adminEditComposant.php");
        }
    }
}