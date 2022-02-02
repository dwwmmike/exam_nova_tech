<?php

class AdminUtilisateurController{
    private $adUser;
    private $adStat;

    public function __construct(){
        $this-> adUser = new AdminUtilisateurModel();
        $this-> adStat = new AdminStatutModel();
    }

    public function listUsers(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $user = new Utilisateur();
            $user -> setIdUtilisateur($id);
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $allUsers = $this->adUser->getUsers($search);
        }else{
            $allUsers = $this->adUser->getUsers();
        }
        require_once("./views/admin/utilisateurs/adminUtilisateursItems.php");
    }

    public function login(){
        if(isset($_POST["soumis"])){
            if (isset($_POST["soumis"]) && strlen($_POST["password"]) >= 4 && !empty($_POST["login"])){
                $login = trim(htmlentities(addslashes($_POST["login"])));
                $password = md5(trim(htmlentities(addslashes($_POST["password"]))));
                $data_u = $this -> adUser -> signIn($login, $password);
                if(!empty($data_u)){
                    session_start();
                    $_SESSION["Auth"] = $data_u;
                    header("location:index.php?action=list_pc");
                }else{
                    $error = "Votre login/email et/ou mot de passe ne correspondent pas";
                }
            }else{
                $error = "Veuillez entrer au moins 4 caractères";
            }
        }
        require_once("./views/admin/utilisateurs/login.php");
    }


    public function addUser(){
        AuthController::isLogged();
        if(isset($_POST["soumis"])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST["password"]) >= 4){
                $nom = trim(htmlentities(addslashes($_POST["nom"])));
                $prenom= trim(htmlentities(addslashes($_POST["prenom"])));
                $email = trim(htmlentities(addslashes($_POST["email"])));
                $password = md5(trim(htmlentities(addslashes($_POST["password"]))));
                $login = trim(htmlentities(addslashes($_POST["login"])));
                $id_statut = trim(htmlentities(addslashes($_POST["statut"])));

                $newU = new Utilisateur();
                $newU->setNom($nom);
                $newU->setPrenom($prenom);
                $newU->setEmail($email);
                $newU->setPassword($password);
                $newU->setLogin($login);
                $newU->getStatut()->setIdStatut($id_statut);

                $ok = $this->adUser->insertUser($newU);
                if($ok){
                    header("location:index.php?action=list_u");
                } 
            }
        }
        $tabStatut = $this -> adStat -> getStatut();

        require_once("./views/admin/utilisateurs/adminAddUtilisateurs.php");
    }

    public function removeUser(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $nbLine = $this -> adUser -> deleteUser($id);
            if($nbLine > 0){
                header("location:index.php?action=list_u");
            }
        }
    }
}
?>