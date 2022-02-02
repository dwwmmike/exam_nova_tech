<?php ob_start(); ?>

<div class="form-style-5">
    <div class="row mt-3">
        <div class="col-6 offset-3">
            <?php if(isset($error)){?>
                <div class="alert alert-danger text-center"><?=$error?></div>
            <?php } ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <h2 class="titleForm">Inscription</h2>
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom...">
                </div>
                <div>
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom...">
                </div>
                <div>
                    <label for="login">Identifiant</label>
                    <input type="text" id="login" name="login" placeholder="Entrez identifiant">
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Entrez mot de passe...">
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Entrez em@il...">
                </div>
                <div>
                    <label for="statut">Age</label>
                    <input type="number" id="age" name="age" placeholder="Entrez age">
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

