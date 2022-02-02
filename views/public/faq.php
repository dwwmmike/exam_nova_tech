<?php ob_start();?>

<div class="container">
<h2 class="text-center text-white">F.A.Q</h2>
<p class="text-danger">QUI SOMMES NOUS ?</p>

<p class="text-white">Nous sommes une entreprise familiale, nous faisons partie du groupe Lulu Shop.

Spécialisée dans la vente d'idées cadeaux, épicerie fine, plaisir autour du bain et gourmandises.

Et également dans la vente de produits dérivés de licences dans l'univers du :

Manga, Cinéma, Série-Tv, Jeux Vidéo, Dessins Animées et Comics.</p>

 

<p class="text-danger">COMMENT PASSER COMMANDE ?</p>

<p class="text-white">Différentes catégorie vous permettre de trouver plus facilement le produit souhaité.

N’hésitez pas à utilisez la fonction recherche en haut à droite.

Ensuite il suffit de cliquer sur le bouton "Ajouter au panier" pour constituer votre commande.

Vous pouvez ensuite valider votre panier ou continuer vos achats.

Vous recevez systématiquement un mail de confirmation lorsque votre commande est enregistrée.

Nous vous informons ensuite par e-mail à chaque étape de votre commande.</p>

 

<p class="text-danger">QUELS SONT LES MODES DE PAIEMENT ?</p>

<p class="text-white">Nous proposons le paiement par carte bancaire avec Paypal, et le paiement par chèque.

Voir les infos et modes de paiement.</p>

 

<p class="text-danger">QJ'AI PERDU MON MOT DE PASSE...COMMENT FAIRE ?</p>

<p class="text-white">QVous pouvez générer un nouveau mot de passe, vous pouvez cliquer depuis la page d'identification sur :

« j'ai perdu mon mot de passe ».

En indiquant votre adresse e-mail, vous recevrez un lien vous permettant de créer un nouveau mot de passe.</p>



<p class="text-danger">QPOURQUOI S'ABONNER À LA NEWSLETTER ?</p>

<p class="text-white">QEn vous abonnant à la newsletter vous recevrez par e-mail les nouveautés,

les bons plans et les promotions de la boutique en ligne.</p>

 

<p class="text-danger">QPLUS DE DÉTAILS SUR UN PRODUIT, C'EST POSSIBLE ?</p>

<p class="text-white">QBien sur, nous sommes aussi là pour vous conseiller et de vous informer sur un produit !

N'hésitez pas à nous contacter.</p>

 

<p class="text-danger">QDANS QUEL DÉLAI MON COLIS SERA-T-IL EXPÉDIER ?</p>

<p class="text-white">QNous expédions les commandes dans un délai de 2 à 5 jours ouvrées.

Une fois la commande expédiée le délai de livraison est de 48 heures.

Nous travaillons principalement avec la poste.

Vous êtes tenu informé tout au long du processus de livraison avec le n° de suivie préalablement reçu par mail.

Pour les précommandes, les délais de disponibilité sont indiqués sur nos fiches produits.</p>

 

<p class="text-danger">QLIVREZ VOUS VERS L’EUROPE ET AILLEURS ?</p>

<p class="text-white">QNous livrons actuellement la plupart des pays européens, si votre pays de livraison n'est pas indiquée,

nous pouvons rajouter votre pays. Contacter nous, nous ferons le nécessaire au plus vite.</p>

 

<p class="text-danger">QPUIS JE ME FAIRE LIVRER MA COMMANDE À UNE AUTRE ADRESSE ?</p>

<p class="text-white">QVous avez bien entendu la possibilité d'entrer une adresse de facturation et une adresse différente de livraison.

Et envoyer votre commande pour offrir en cadeau à une autre adresse.</p>

 

<p class="text-danger">QJE SOUHAITE RETOURNER UN PRODUIT, COMMENT FAIRE ?</p>

<p class="text-white">QSi pour une raison, vous n'êtes pas satisfait(e) de votre commande :

vous disposez d'un délai de 7 jours ouvrables à compter de la réception des articles pour nous les retourner.

Vous trouverez plus d'infos sur les retours de commande.</p>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>