<?php

if(!isset($_SESSION)) {
    session_start();
}

class AuthUserController{
    private $cm;

    public function __construct(){
        $this->cm = new ClientModel();
    }
    public static function isULogged(){
        if(!isset($_SESSION['AuthU'])){
            header('location:index.php?action=loginU');
            exit;
        }
    }

    public static function logUout(){
        unset($_SESSION['AuthU']);
        header('location:index.php');
        
    }

    public function loginU(){
        if(isset($_POST["soumis"])){
            if (isset($_POST["soumis"]) && strlen($_POST["password"]) >= 4 && !empty($_POST["login"])){
                $login = trim(htmlentities(addslashes($_POST["login"])));
                $password = md5(trim(htmlentities(addslashes($_POST["password"]))));
                $data_cli = $this->cm->signInU($login, $password);
                if(!empty($data_cli)){
                    session_start();
                    $_SESSION["AuthU"] = $data_cli;       
                    header("location:index.php?action=compte");
                }else{
                    $error = "Votre login/email et/ou mot de passe ne correspondent pas";
                }
            }else{
                $error = "Veuillez entrer au moins 4 caractères";
            }
        }
        require_once('./views/public/loginU.php');
    }

}
?>

