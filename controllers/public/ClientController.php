<?php

class ClientController
{

    private $adClient;
    private $am;
    private $authController;

    public function __construct()
    {
        $this->adClient = new ClientModel();
        $this->am = new AdresseModel();
        $this->authController = new AuthUserController();

        $this->comm = new CommandeModel();
    }

    public function compte(){
        AuthUserController::isULogged();

        $method = isset($_GET['method']) ? $_GET['method'] : '';
        $id = isset($_GET['id']) && $method == 'commande' ? trim(htmlentities(addslashes($_GET['id']))) : 0;

        $client = $_SESSION['AuthU']->id_client;
        $commandes = $this->comm->getCommandes($client, $id);
        $adresses = $this->am->getAdresses($client);

        require_once('./views/public/compte.php');
    }

    public function addClient()
    {

        if (isset($_POST["soumis"])) {
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST["password"]) >= 4) {
                $nom = trim(htmlentities(addslashes($_POST["nom"])));
                $prenom = trim(htmlentities(addslashes($_POST["prenom"])));
                $email = trim(htmlentities(addslashes($_POST["email"])));
                $password = md5(trim(htmlentities(addslashes($_POST["password"]))));
                $login = trim(htmlentities(addslashes($_POST["login"])));
                $age = trim(htmlentities(addslashes($_POST["age"])));

                $newU = new Client();
                $newU->setNom($nom);
                $newU->setPrenom($prenom);
                $newU->setEmail($email);
                $newU->setAge($age);
                $newU->setPassword($password);
                $newU->setLogin($login);

                $ok = $this->adClient->register($newU);

                if ($ok) {

                    $data_cli = $this->adClient->signInU($login, $password);
                    if(!empty($data_cli)){
                        session_start();
                        $_SESSION["AuthU"] = $data_cli;
                        header("location:index.php?action=adresse");
                    }

                    $error = "Impossible de créer un compte";
                }
            }
        }

        require_once("./views/public/inscription.php");
    }

}