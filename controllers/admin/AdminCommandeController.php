<?php

class AdminCommandeController {

    private $adCommande;

    public function __construct(){
        $this-> adCommande = new AdminCommandeModel();
    }

    public function listCommandes(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $comp = new Commande();
            $comp -> setIdCommande($id);
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $allCommandes = $this->adCommande->getCommandes($search);
        }else{
            $allCommandes = $this->adCommande->getCommandes();
        }
        
        require_once("./views/admin/commandes/adminCommandesItems.php");
    }

    public function voirCommande(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $commande = new Commande();
            $commande -> setIdCommande($id);
            $commande = $this->adCommande->itemCommande($commande);
        }

        require_once("./views/admin/commandes/adminCommandesItemsPcs.php");
    }

}