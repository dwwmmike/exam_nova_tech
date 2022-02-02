<?php ob_start(); ?>

<h2>Nos Composants</h2>
<div class="categorie">

<?php if (is_array($allComps)) {
    foreach ($allComps as $comp) { ?>
        <div id="container-card">
            <div class="product-details">
                <h1><?= $comp->getNomComposant(); ?></h1>
                <p class="information"><?= $comp->getDescription(); ?></p>
                <div class="control">
                    <div class="btn-card">
                        <span class="price"><?= $comp->getPrix(); ?> €</span>
                        <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                        <span class="buy">
                             <form method="post" action="index.php?action=panier">
                                    <input type="hidden" name="method" value="ajout"/>
                                    <input type="hidden" name="id" value="<?= $comp->getIdComposant(); ?>"/>
                                    <input type="hidden" name="t" value="composant"/>
                                    <input type="hidden" name="i" value="<?= $comp->getImage(); ?>"/>
                                    <input type="hidden" name="l" value="<?= $comp->getNomComposant(); ?>"/>
                                    <input type="hidden" name="p" value="<?= $comp->getPrix(); ?>"/>
                                    <input type="hidden" name="q" value="1"/>
                                    <button type="submit"><i class="fab fa-stripe"></i></button>
                                </form>
                        </span>
                    </div>
                </div>
            </div>
            <div class="product-image">
                <img src="./assets/images/<?= $comp->getImage(); ?>" alt="" width="100">
                <div class="info">
                    <h2>Description</h2>
                    <ul>
                        <li><strong>Quantitée: </strong><?= $comp->getQuantite(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php }
} else {
    echo "<tr class='text-center text-danger'><td colspan='10' >" . $allComps . "</td></tr>";
} ?>

</div>
<?php
$contenu = ob_get_clean();
require_once('./views/public/templatePublic.php');
?>
