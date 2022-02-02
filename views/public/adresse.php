<?php ob_start(); ?>

<div class="form-style-5">
    <div class="row mt-3">
        <div class="col-6 offset-3">
            <?php if(isset($error)){?>
                <div class="alert alert-danger text-center"><?=$error?></div>
            <?php } ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <h2 class="titleForm">Ajouter une adresse</h2>
                <div>
                    <label for="nom">Rue</label>
                    <input type="text" id="rue" name="rue" placeholder="Entrez la rue...">
                </div>
                <div>
                    <label for="prenom">Complément</label>
                    <input type="text" id="complement" name="complement" placeholder="Entrez le complément d'adresse...">
                </div>
                <div>
                    <label for="login">Code postal</label>
                    <input type="text" id="code_postal" name="code_postal" placeholder="Entrez le Code postal">
                </div>
                <div>
                    <label for="password">Ville</label>
                    <input type="text" id="ville" name="ville" placeholder="Entrez la ville...">
                </div>
                <button type="submit" name="soumis">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>

