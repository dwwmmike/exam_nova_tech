<?php

class AdresseController
{

    private $adAdressse;

    public function __construct()
    {
        $this->adAdressse = new AdresseModel();
    }

    public function addAdresse()
    {
        AuthUserController::isULogged();
        if (isset($_POST["soumis"])) {
            $rue = trim(htmlentities(addslashes($_POST["rue"])));
            $ville = trim(htmlentities(addslashes($_POST["ville"])));
            $complement = trim(htmlentities(addslashes($_POST["complement"])));
            $code_postal = trim(htmlentities(addslashes($_POST["code_postal"])));

            $client = new Client();
            $client->setIdClient($_SESSION['AuthU']->id_client);

            $adresse = new Adresse();
            $adresse->setRue($rue);
            $adresse->setVille($ville);
            $adresse->setComplement($complement);
            $adresse->setCodePostal($code_postal);
            $adresse->setClient($client);

            $ok = $this->adAdressse->ajoutAdresse($adresse);
            if ($ok) {
                $idAdresse = $this->adAdressse->getAjoutAdresseId();

                $_SESSION['AdresseU'] = $this->adAdressse->getAdresse($idAdresse);

                header("location:index.php?action=compte");
            }
        }

        require_once("./views/public/adresse.php");
    }

}