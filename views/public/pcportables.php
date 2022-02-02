<?php ob_start(); ?>

<h2>Nos PC Portables</h2>

<div class="categorie">
<?php if (is_array($pcps)) {
    foreach ($pcps as $pcp) { ?>
        <div id="container-card">
            <div class="product-details">
                <h1><?= $pcp->getNom(); ?></h1>
                <p class="information"><?= $pcp->getDescription(); ?></p>
                <div class="control">
                    <div class="btn-card">
                        <span class="price"><?= $pcp->getPrix(); ?> €</span>
                        <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                        <span class="buy">
                            <form method="post" action="index.php?action=panier">
                                <input type="hidden" name="method" value="ajout"/>
                                <input type="hidden" name="id" value="<?= $pcp->getIdPcPortable(); ?>"/>
                                <input type="hidden" name="t" value="portable"/>
                                <input type="hidden" name="i" value="<?= $pcp->getImage(); ?>"/>
                                <input type="hidden" name="l" value="<?= $pcp->getNom(); ?>"/>
                                <input type="hidden" name="p" value="<?= $pcp->getPrix(); ?>"/>
                                <input type="hidden" name="q" value="1"/>
                                <button type="submit"><i class="fab fa-stripe"></i></button>
                            </form>
                        </span>
                    </div>
                </div>
            </div>
            <div class="product-image">
                <img src="./assets/images/<?= $pcp->getImage(); ?>">
                <div class="info">
                    <h2>Description</h2>
                    <ul>
                        <li><strong>Date de sortie: </strong><?= $pcp->getDate(); ?></li>
                        <li><strong>Quantitée: </strong><?= $pcp->getQuantite(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php }
} else {
    echo "<tr class='text-center text-danger'><td colspan='10' >" . $pcps . "</td></tr>";
} ?>
</div>
<?php
$contenu = ob_get_clean();
require_once('./views/public/templatePublic.php');
?>
