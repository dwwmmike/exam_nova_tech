<?php ob_start();?>

<div class="container">
<div class="alert alert-danger text-center" role="alert">
  Echec de paiment
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>