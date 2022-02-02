<?php ob_start(); ?>

<h2>Nos PC Gamers</h2>
<!-- ----------------------------------------------------------- -->
<div class="categorie">

<?php if (is_array($pcs)) {
    foreach ($pcs as $pc) { ?>
        <div id="container-card">
            <div class="product-details">
                <h1><?= $pc->getNom(); ?></h1>
                <p class="information"><?= $pc->getDescription(); ?></p>
                <div class="control">
                    <div class="btn-card">
                        <span class="price"><?= $pc->getPrix(); ?> €</span>
                        <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                        <span class="buy">
                           <form method="post" action="index.php?action=panier">
                                <input type="hidden" name="method" value="ajout"/>
                                <input type="hidden" name="id" value="<?= $pc->getIdPcGamer(); ?>"/>
                                <input type="hidden" name="t" value="gamer"/>
                                <input type="hidden" name="i" value="<?= $pc->getImage(); ?>"/>
                                <input type="hidden" name="l" value="<?= $pc->getNom(); ?>"/>
                                <input type="hidden" name="p" value="<?= $pc->getPrix(); ?>"/>
                                <input type="hidden" name="q" value="1"/>
                                <button type="submit"><i class="fab fa-stripe"></i></button>
                            </form>
                       </span>
                    </div>
                </div>
            </div>
            <div class="product-image">
                <img src="./assets/images/<?= $pc->getImage(); ?>" alt="" width="100">
                <div class="info">
                    <h2>Description</h2>
                    <ul>
                        <li><strong>Date de sortie: </strong><?= $pc->getDate(); ?></li>
                        <li><strong>Quantitée: </strong><?= $pc->getQuantite(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php }
} else {
    echo "<tr class='text-center text-danger'><td colspan='10' >" . $pcs . "</td></tr>";
} ?>

</div>

<?php
$contenu = ob_get_clean();
require_once('./views/public/templatePublic.php');
?>
