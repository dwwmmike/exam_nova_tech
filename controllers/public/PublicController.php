<?php
session_start();
require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PublicController{

    private $pubpcm;
    private $adpcpm;
    private $adComposant;

    public function __construct()
    {
        $this->pubpcm = new AdminPcModel();
        $this->adComposant = new AdminComposantModel();
        $this->adpcpm = new AdminPcPortableModel();

    }

    public function getHome(){
        require_once('./views/public/accueil.php');
    }
    public function about() {
        require_once('./views/public/about.php');
    }
    public function legalment(){
        require_once('./views/public/mentionslegales.php');
    }
    public function sended(){
        require_once('./views/public/send.php');

    }
    
    public function listArt(){
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $pcs = $this->pubpcm->getPcs($search);
        }else{
            $pcs = $this->pubpcm->getPcs();
        }
       require_once("./views/public/pcgamers.php");
    }

    public function listPcPortables(){
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $pcPortable = new PcPortable();
            $pcPortable -> setIdPcPortable($id);
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $pcps = $this->adpcpm->getPcPortables($search);
        }else{
            $pcps = $this->adpcpm->getPcPortables();
            
        }
       require_once("./views/public/pcportables.php");
    }
    
    public function listComponents(){
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
        require_once("./views/public/composants.php");
    }

    public function contact() {

        if(isset($_POST['submit'])) {
            $emailFrom = addslashes(htmlspecialchars($_POST['email']));
            $message = addslashes(htmlspecialchars($_POST['message']));
            $nom = addslashes(htmlspecialchars($_POST['nom']));
            $email = addslashes(htmlspecialchars($_POST['email']));
            $prenom = addslashes(htmlspecialchars($_POST['prenom']));
            $telephone = addslashes(htmlspecialchars($_POST['tel']));
            $adresse = addslashes(htmlspecialchars($_POST['adresse']));
            $emailFromName = $nom.' '.$prenom;
            $messageClient = "
                    <h2>Message de client</h2>
                    <div>
                    <p>Message de $nom $prenom $emailFrom:</p>
                    <p>$message</p>
                    <p>$telephone</p>
                    <p>$adresse</p>
                    </div>
                ";
            $messageConf = "
            <h2>Confirmation d'envoie email</h2>
            <div>
            <p>Nous vous remercions pour votre message.</p>
            </div>
            ";
            $this->sendMail($email, 'Confirmation envoie email', $messageConf);
            $this->sendMail('dwwmmike@gmail.com', 'Contact', $messageClient, $emailFrom, $emailFromName);
            $this->sended();   
        }
        require_once('./views/public/contact.php');
    }

    public function sendMail($email, $objet, $message, $emailFrom = 'dwwmmike@gmail.com', $emailFromName = 'NovaTech'){
        $mail = new PHPMailer(true); 
        try {                    
            $mail->isSMTP();  
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'dwwmmike@gmail.com';                     
            $mail->Password   = 'dwwm2020';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                               

            $mail->setFrom($emailFrom, $emailFromName);
            $mail->addAddress("$email","$objet","$message", 'Mr/Mme');     

            $mail->isHTML(true);                                  
            $mail->Subject = $objet;
            $mail->Body    = $message;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function payment(){
        
        if (isset($_POST) && !empty($_POST['email'])) {
            \Stripe\Stripe::setApiKey('sk_test_51IM8ZTHlq7zZEqVgK2dLM0PztZLbGTAKRkJLqWASDVctfiHv0zL0J5BSmBmUZBbNM39nnmqWmdnHSBcbwWgd4WEu00Z7Y2fcaE');
            header('Content-Type: application/json');

            $products = [];
            foreach ($_SESSION['panier']['libelleProduit'] as $i => $nom) {
                $products[] =  [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $_SESSION['panier']['prixProduit'][$i] * 100,
                        'product_data' => [
                            'name' => $nom
                        ],
                    ],
                    'quantity' => $_SESSION['panier']['qteProduit'][$i],
                ];
            }

            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $products,
                'customer_email' => $_POST['email'],
                'mode' => 'payment',
                'success_url' => 'http://localhost:8888/exam_29062021/index.php?action=success',
                'cancel_url' => 'http://localhost:8888/exam_29062021/index.php?action=cancel',
            ]);

            $_SESSION['pay'] = $_POST;
            echo json_encode(['id' => $checkout_session->id]);
        }

    }
    public function listSearch(){
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $pcs = $this->pubpcm->getPcs($search);
        }else{
            $pcs = $this->pubpcm->getPcs();
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $pcps = $this->adpcpm->getPcPortables($search);
        }else{
            $pcps = $this->adpcpm->getPcPortables();
        }
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $allComps = $this->adComposant->getComponents($search);
        }else{
            $allComps = $this->adComposant->getComponents();
        }
       require_once("./views/public/templatePublic.php");
    }
}
?>