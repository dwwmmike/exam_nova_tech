<?php
require_once("./app/autoload.php");
class Router{
    private $ctrpc;
    private $ctru;
    private $ctrcomp;
    private $ctrpcp;
    private $ctrtype;
    private $ctrpub;
    private $ctrcli;
    private $ctrcmd;
    private $ctrp;
    private $ctrauthu;
    private $ctrc;
    private $ctradr;

    public function __construct(){
        $this->ctrpc = new AdminPcController();
        $this->ctru = new AdminUtilisateurController();
        $this->ctrcomp = new AdmincomposantController();
        $this->ctrpcp = new AdminPcPortablesController();
        $this->ctrtype = new AdminTypeController();
        $this->ctrpub = new PublicController();
        $this->ctrcli = new AdminClientController();
        $this->ctrcmd = new AdminCommandeController();
        $this->ctrp = new PanierController();
        $this->ctrauthu = new AuthUserController;
        $this->ctrc = new ClientController();
        $this->ctradr = new AdresseController();

    }
    public function getPath(){
        try{
            if(isset($_GET["action"])){
                switch($_GET["action"]){
                    case "list_pc" :
                        $this->ctrpc->listPcs();
                        break;
                    case "add_pc" :
                        $this->ctrpc->addPc();
                        break;
                    case "delete_pc" :
                        $this->ctrpc->removePc();
                        break;
                    case "edit_pc" :
                        $this->ctrpc->editPc();
                        break;
                    case "delete_pc_gamer_composant" :
                        $this->ctrpc->deletePcGamerComposant(); 
                        break;
                    case "login" :
                        $this->ctru->login();
                        break;
                    case "logout" :
                        AuthController::logout();
                        break;
                    case "list_u" :
                        $this->ctru->listUsers(); 
                        break;
                    case "add_u" :
                        $this->ctru->addUser(); 
                        break;
                    case "delete_user" :
                        $this->ctru->removeUser(); 
                        break;
                    case "list_comp" :
                        $this->ctrcomp->listComponents();
                        break;
                    case "add_comp" :
                        $this->ctrcomp->addComp(); 
                        break;
                    case "list_type" :
                        $this->ctrtype->listTypes();
                        break;
                    case "delete_pcp" :
                        $this->ctrpcp->removePcp();
                        break;
                    case "delete_type" :
                        $this->ctrtype->removeType(); 
                        break;
                    case "delete_comp" :
                        $this->ctrcomp->removeComp(); 
                        break;
                    case "add_pcp" :
                        $this->ctrpcp->addPcPortable();
                        break;    
                    case "list_pcp" :
                        $this->ctrpcp->listPcPortables(); 
                        break;
                    case "edit_pcp" :
                        $this->ctrpcp->editPcP(); 
                        break;
                    case "edit_comp" :
                        $this->ctrcomp->editComp(); 
                        break;
                    case "add_type" :
                        $this->ctrtype->addType(); 
                        break;
                    case "edit_type" :
                        $this->ctrtype->editType(); 
                        break;
                    case 'about': 
                        $this->ctrpub->about();
                        break;
                    case 'legalment':
                        $this->ctrpub->legalment();
                        break;
                    case 'contact':
                        $this->ctrpub->contact();
                        break;
                    case 'pc_gamers':
                        $this->ctrpub->listArt();
                        break;
                    case "list_client" :
                        $this->ctrcli->listClients();
                        break;
                    case "item_client" :
                        $this->ctrcli->voirClient();
                        break;
                    case "list_commandes" :
                        $this->ctrcmd->listCommandes();
                        break;
                    case "item_commande" :
                        $this->ctrcmd->voirCommande();
                        break;
                    case "pc_portables" :
                        $this->ctrpub->listPcPortables();
                        break;
                    case "components" :
                        $this->ctrpub->listComponents();
                        break;
                    case "panier":
                        $this->ctrp->panier();
                        break;
                    case "success":
                        $this->ctrp->success();
                        break;
                    case "cancel":
                        $this->ctrp->cancel();
                        break;
                    case "loginU":
                        $this->ctrauthu->loginU();
                        break;
                    case "compte":
                        $this->ctrc->compte();
                        break;
                    case "loguout" :
                        $this->ctrauthu->logUout();
                        break;
                    case "inscription" :
                        $this->ctrc->addClient();
                        break;
                    case "adresse" :
                        $this->ctradr->addAdresse();
                        break;
                    case "supppanier":
                        $this->ctrp->supprimePanier();
                        break;
                    case 'pay': 
                        $this->ctrpub->payment();
                        break;
                    default:
                        throw new Exception('Action non définie');
                }
            }
            else{
                $this->ctrpub->getHome();
            }
            
        }
        catch (Exception $e) {
            $this->page404($e->getMessage());
        }
    }
    private function page404($errorMsg){
        require_once('./views/public/404.php');
    }
}
?>