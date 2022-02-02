<?php ob_start(); ?>

<div class="form-style-5">
<h2>Modifier <?=$editType->getNomType();?></h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="col">
                <label for="nom_type">Nom</label>
                <input type="text" id="nom_type" name="nom_type" class="form-control" placeholder="Entrez un nom..." value="<?=$editType->getNomType();?>">
            </div>
        <button type="submit"  name="soumis" style="border-radius: 30px;">Modifier</button>
    </form>
</div>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>
