<?php

class AdminClientController {

    private $adcli;
    private $adadr;

    public function __construct(){
        $this-> adcli = new AdminCLientModel();
        $this-> adadr = new AdminAdresseModel();
    }

    public function listClients(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $comp = new Commande();
            $comp -> setIdCommande($id);
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $allClients = $this->adcli->getClients($search);
        }else{
            $allClients = $this->adcli->getClients();
        }
        
        require_once("./views/admin/client/adminClientsItems.php");
    }

    public function voirClient(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $client = new Client();
            $client -> setIdClient($id);
            $client = $this->adcli->itemClient($client);

            $adresses = $this->adadr->getAdresses($client);
        }

        require_once("./views/admin/client/adminClientItemsAdresses.php");
    }

}