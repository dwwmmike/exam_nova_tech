<?php ob_start();?>

  <h2>Merci pour votre achat!</h2>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>