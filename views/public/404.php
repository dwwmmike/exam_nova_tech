<?php ob_start();?>

<img src="./assets/images/error.png" class="d-block w-100" alt="...">
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
    
?>