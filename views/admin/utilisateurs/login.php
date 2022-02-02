<?php ob_start(); ?>

<div class="form-style-5">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Formulaire de connexion</h2>
    <div class="row mt-3">
        <div class="col-6 offset-3">
            <?php if(isset($error)){?>
                <div class="alert alert-danger text-center"><?=$error?></div>
            <?php } ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center">
               
                <div class=" mb-4 col">
                    <label for="login">Login ou Email*</label>
                    <input type="text" id="login" name="login" class="form-control mt-3" placeholder="Veuillez entrez votre login ou votre email">
                </div>
                <div class="mb-4 col">
                    <label for="password">Mot de passe*</label>
                    <input type="password" id="password" name="password" class="form-control mt-3" placeholder="Veuillez entrez votre mot de passe">
                </div>
                
                <button type="submit" class="btn btn-dark text-warning col-12 mt-2" name="soumis">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>