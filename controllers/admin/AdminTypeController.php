<?php

class AdminTypeController{
    private $adtm;

     public function __construct(){
        $this->adtm = new AdminTypeModel();
    }

    public function listTypes(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $types = $this->adtm->getTypeComposant($search);
            require_once("./views/admin/composants/adminTypeItems.php");
        }else{
            $types = $this->adtm->getTypeComposant();
            require_once("./views/admin/composants/adminTypeItems.php");
        }
       
    }

    public function editType(){
        AuthController::isLogged();
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $editType = new TypeComposant;
            $editType->setIdTypeComposant($id);
            $editType = $this->adtm->typeItem($editType); 
        
            if(isset($_POST["soumis"]) && !empty($_POST["nom_type"])){
                $nom_type = addslashes(htmlspecialchars(trim($_POST["nom_type"])));
                $editType->setNomType($nom_type);
                $type_updated = $this->adtm->updateTypeComposant($editType);
                header("location:index.php?action=list_type");
            }
            require_once("./views/admin/composants/adminEditType.php");
        }
    }


    public function removeType(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $nbLine = $this -> adtm -> deleteType($id);
            if($nbLine > 0){
                header("location:index.php?action=list_type");
            }
        }
    }

    public function addType(){
        AuthController::isLogged();
        if(isset($_POST["soumis"])){
            $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));

            $newType = new TypeComposant();
            $newType->setNomType($nom);

            $type_added = $this->adtm->insertType($newType);
            if($type_added){
                header("location:index.php?action=list_type");
            }
        }
        require_once("./views/admin/composants/adminAddTypeComposant.php");
    }
    



}