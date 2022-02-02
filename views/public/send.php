<?php ob_start();?>

  <h2>Message envoyé avec succès!</h2>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>