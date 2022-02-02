<?php ob_start(); ?>
<div class="form-style-5">

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <h2 class="titleForm">Contact</h2>
        <div class="contact-form"></div>
        <div class="mb-3">
            <label for="objet" class="form-label text-white">Objet</label>
            <input type="text" class="form-control" id="objet" name="objet" placeholder="Entrez l'objet...">
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label text-white">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom...">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label text-white">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom...">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-white">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   placeholder="Entrez votre adresse email...">
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label text-white">Adresse</label>
            <input type="adresse" class="form-control" id="adresse" name="adresse"
                   placeholder="Entrez votre adresse...">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label text-white">Téléphone</label>
            <input type="tel" class="form-control" id="tel" name="tel"
                   placeholder="Entre votre numéro de téléphone...">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label text-white">Message</label>
            <textarea class="form-control" name="message" placeholder="Entrez votre message..."
                      id="message"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-secondary col-12 mb-2">Envoyer</button>
    </form>
</div>
</div>
<?php
$contenu = ob_get_clean();
require_once('./views/public/templatePublic.php');
?>