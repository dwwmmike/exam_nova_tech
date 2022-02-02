<?php


class PanierController
{

    private $comm;

    public function __construct()
    {
        $this->comm = new CommandeModel();

    }

    public function panier()
    {
        $erreur = false;

        $action = (isset($_POST['method']) ? $_POST['method'] : (isset($_GET['method']) ? $_GET['method'] : null));

        if ($action !== null) {
            if (!in_array($action, array('ajout', 'suppression', 'refresh')))
                $erreur = true;

            $id = (isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : null));
            $l = (isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null));
            $p = (isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null));
            $q = (isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null));
            $i = (isset($_POST['i']) ? $_POST['i'] : (isset($_GET['i']) ? $_GET['i'] : null));
            $t = (isset($_POST['t']) ? $_POST['t'] : (isset($_GET['t']) ? $_GET['t'] : null));

            $l = preg_replace('#\v#', '', $l);

            $p = floatval($p);

            if (is_array($q)) {
                $QteArticle = array();
                $i = 0;
                foreach ($q as $contenu) {
                    $QteArticle[$i++] = intval($contenu);
                }
            } else
                $q = intval($q);
        }

        if (!$erreur) {
            switch ($action) {
                case "ajout":
                    $this->ajouterArticle($i, $id, $l, $q, $p, $t);
                    break;

                case "suppression":
                    $this->supprimerArticle($l);
                    break;

                case "refresh" :
                    for ($i = 0; $i < count($QteArticle); $i++) {
                        $this->modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
                    }
                    break;

                default:
                    break;
            }
        }

        $panier = $this->creationPanier();
        $montant = $this->MontantGlobal();
        require_once('./views/public/panier.php');
    }

    function creationPanier()
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['idProduit'] = array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['image'] = array();
            $_SESSION['panier']['type'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }

    function ajouterArticle($imageProduit, $idProduit, $libelleProduit, $qteProduit, $prixProduit, $type)
    {

        if ($this->creationPanier() && !$this->isVerrouille()) {

            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            } else {
                array_push($_SESSION['panier']['idProduit'], $idProduit);
                array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
                array_push($_SESSION['panier']['qteProduit'], $qteProduit);
                array_push($_SESSION['panier']['prixProduit'], $prixProduit);
                array_push($_SESSION['panier']['image'], $imageProduit);
                array_push($_SESSION['panier']['type'], $type);
            }
        } else
            return "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    function modifierQTeArticle($libelleProduit, $qteProduit)
    {
        if ($this->creationPanier() && !$this->isVerrouille()) {

            if ($qteProduit > 0) {
                $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);
                if ($positionProduit !== false) {
                    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
                }
            } else
                $this->supprimerArticle($libelleProduit);
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    function supprimerArticle($libelleProduit)
    {
        if ($this->creationPanier() && !$this->isVerrouille()) {
            $tmp = array();
            $tmp['idProduit'] = array();
            $tmp['libelleProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['image'] = array();
            $tmp['type'] = array();

            for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
                if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit) {
                    array_push($tmp['idProduit'], $_SESSION['panier']['idProduit'][$i]);
                    array_push($tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                    array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                    array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
                    array_push($tmp['type'], $_SESSION['panier']['type'][$i]);
                    array_push($tmp['image'], $_SESSION['panier']['image'][$i]);
                }
            }
            $_SESSION['panier'] = $tmp;
            unset($tmp);
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    function MontantGlobal()
    {
        $total = 0;
        for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }


    function supprimePanier()
    {
        unset($_SESSION['panier']);
        header("location:index.php?action=panier");
    }

    function isVerrouille()
    {
        if (isset($_SESSION['panier']) && isset($_SESSION['panier']['verrou']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    function compterArticles()
    {
        if (isset($_SESSION['panier']))
            return count($_SESSION['panier']['libelleProduit']);
        else
            return 0;

    }

    public function success(){
        unset($_SESSION['panier']);
        require_once('./views/public/success.php');
        
    }

    public function cancel()
    {
        require_once('./views/public/cancel.php');
    }

}

?>
