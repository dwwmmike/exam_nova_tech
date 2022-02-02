<?php ob_start(); ?>

    <h2>Compte</h2>
    <div class="compte">

    <div class="leftnavbar">
        <p>Bienvenue <?= $_SESSION['AuthU']->nom ?>,</p>
        <ul>
            <li><a href="index.php?action=compte"> Mes coordonnées</a></li>
            <li><a href="index.php?action=compte&method=adresse"> Mes adresses</a></li>
            <!-- <li><a href="index.php?action=compte&method=commande"> Mes commandes</a></li> -->
        </ul>
    </div>

    <div class="rightcompte">

        <?php if (!empty($method)) {
            if ($method == 'commande' && (!empty($commandes) && is_array($commandes))) {

                if ($id) {
                    $commande = $commandes[0];
                    ?>
                    <h3>Ma commande <?= $commande->getReference(); ?></h3>
                    <table class="fl-table">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if (is_array($commande->getCommandePcGamers())) {
                            foreach ($commande->getCommandePcGamers() as $commandepc) {
                                $pc = $commandepc->getPcGamer();
                                ?>
                                <tr>
                                    <td><?= $pc->getNom(); ?></td>
                                    <td><?= $pc->getPrix(); ?> €</td>
                                    <td><img src="./assets/images/<?= $pc->getImage(); ?>" alt="" width="100"></td>
                                </tr>

                            <?php }

                            foreach ($commande->getCommandePcPortables() as $commandepcp) {
                                $pc = $commandepcp->getPcPortable();
                                ?>
                                <tr>
                                    <td><?= $pc->getNom(); ?></td>
                                    <td><?= $pc->getPrix(); ?> €</td>
                                    <td><img src="./assets/images/<?= $pc->getImage(); ?>" alt="" width="100"></td>
                                </tr>

                            <?php }

                            foreach ($commande->getCommandeComposants() as $commandeComp) {
                                $c = $commandeComp->getComposant();
                                ?>
                                <tr>
                                    <td><?= $c->getNomComposant(); ?></td>
                                    <td><?= $c->getPrix(); ?> €</td>
                                    <td><img src="./assets/images/<?= $c->getImage(); ?>" alt="" width="100"></td>
                                </tr>

                            <?php }
                        } ?>
                        <tr class="total-commande">
                            <td colspan="7">Total :  <?= $commande->getTotal(); ?> €</td>
                        </tr>
                        </tbody>
                    </table>

                <?php } else { ?>

                    <h3>Mes commandes</h3>
                    <div class="scroll">
                    <table>
                        <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Total</th>
                            <th>Adresse de livraison</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php


                        foreach ($commandes as $commande) {

                            ?>
                            <tr>
                                <td><?= $commande->getReference(); ?></td>
                                <td><?= $commande->getTotal(); ?> €</td>
                                <td><?= $commande->getAdresse()->getRue(); ?>
                                    , <?= !empty($commande->getAdresse()->getComplement()) ? $commande->getAdresse()->getComplement() . ', ' : ''; ?> <?= $commande->getAdresse()->getCodePostal(); ?>
                                    , <?= $commande->getAdresse()->getVille(); ?> </td>
                                <td>
                                    <a href="index.php?action=compte&method=commande&id=<?= $commande->getIdCommande(); ?>">
                                        <button>Voir</button>
                                    </a></td>
                            </tr>
                        <?php }


                        ?>
                    </table>
                    </div>
                <?php }
            }

            if ($method == 'adresse') { ?>

                <h3>Mes adresses</h3>
                <div class="scroll">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Rue</th>
                        <th>Complement</th>
                        <th>Code Postal</th>
                        <th>Ville</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php if (is_array($adresses)){
                        foreach ($adresses

                        as  $adresse) {
                        ?>
                        <td><?= $adresse->getRue(); ?></td>
                        <td><?= $adresse->getComplement(); ?></td>
                        <td><?= $adresse->getCodePostal(); ?></td>
                        <td><?= $adresse->getVille(); ?></td>
                    </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
                </div>
                <a href="index.php?action=adresse">
                    <button>Ajouter une adresse</button>
                </a>
                </p>
                <?php
            }
        } else { ?>
            <h2>Mes coordonnées</h2>
            <p><strong>Nom :</strong> <?= $_SESSION['AuthU']->nom ?></p>
            <p><strong>Prenom :</strong> <?= $_SESSION['AuthU']->prenom ?></p>
            <p><strong>Email :</strong> <?= $_SESSION['AuthU']->email ?></p>
            <p><strong>Age :</strong> <?= $_SESSION['AuthU']->age ?></p>
        <?php } ?>
    </div>
<?php
$contenu = ob_get_clean();
require_once('./views/public/templatePublic.php');
?>