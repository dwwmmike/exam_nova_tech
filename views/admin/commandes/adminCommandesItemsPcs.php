<?php ob_start(); ?>

    <h2>Commande <?= $commande->getIdCommande(); ?></h2>

    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Reference</th>
            <th>Poids</th>
            <th>Total</th>
            <th>Client</th>
            <th>Adresse</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $commande->getIdCommande(); ?></td>
            <td><?= $commande->getReference(); ?></td>
            <td><?= $commande->getPoids(); ?></td>
            <td><?= $commande->getTotal(); ?></td>
            <td><?= $commande->getClient()->getNom(); ?> <?= $commande->getClient()->getPrenom(); ?> </td>
            <td><?= $commande->getAdresse()->getRue(); ?>
                , <?= !empty($commande->getAdresse()->getComplement()) ? $commande->getAdresse()->getComplement() . ', ' : ''; ?> <?= $commande->getAdresse()->getCodePostal(); ?>
                , <?= $commande->getAdresse()->getVille(); ?> </td>
        </tr>

        </tbody>
    </table>

    <h3>Liste des produits</h3>

    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Quantite</th>
            <th>Date</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>

        <?php if (is_array($commande->getCommandePcGamers())) {
            foreach ($commande->getCommandePcGamers() as $commandepc) {
                $pc = $commandepc->getPcGamer();
                ?>
                <tr>
                    <td><?= $pc->getIdPcGamer(); ?></td>
                    <td><?= $pc->getNom(); ?></td>
                    <td><?= $pc->getPrix(); ?> €</td>
                    <td><img src="./assets/images/<?= $pc->getImage(); ?>" alt="" width="100"></td>
                    <td><?= $pc->getQuantite(); ?></td>
                    <td><?= $pc->getDate(); ?></td>
                    <td><?= substr($pc->getDescription(), 0, 19); ?></td>
                </tr>

            <?php }

            foreach ($commande->getCommandePcPortables() as $commandepcp) {
                $pc = $commandepcp->getPcPortable();
                ?>
                <tr>
                    <td><?= $pc->getIdPcPortable(); ?></td>
                    <td><?= $pc->getNom(); ?></td>
                    <td><?= $pc->getPrix(); ?> €</td>
                    <td><img src="./assets/images/<?= $pc->getImage(); ?>" alt="" width="100"></td>
                    <td><?= $pc->getQuantite(); ?></td>
                    <td><?= $pc->getDate(); ?></td>
                    <td><?= substr($pc->getDescription(), 0, 19); ?></td>
                </tr>

            <?php }

            foreach ($commande->getCommandeComposants() as $commandeComp) {
                $c = $commandeComp->getComposant();
                ?>
                <tr>
                    <td><?= $c->getIdComposant(); ?></td>
                    <td><?= $c->getNomComposant(); ?></td>
                    <td><?= $c->getPrix(); ?> €</td>
                    <td><img src="./assets/images/<?= $c->getImage(); ?>" alt="" width="100"></td>
                    <td><?= $c->getQuantite(); ?></td>
                    <td></td>
                    <td><?= substr($c->getDescription(), 0, 19); ?></td>
                </tr>

            <?php }
        } ?>
        </tbody>
    </table>

<?php
$contenu = ob_get_clean();
require_once('./views/templateAdmin.php');
?>