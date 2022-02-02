<?php ob_start(); ?>

    <h2>Liste des commandes</h2>
    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Reference</th>
            <th>Poids</th>
            <th>Total</th>
            <th>Client</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if( !empty($allCommandes) && is_array($allCommandes)){
            foreach($allCommandes as $commande){?>
                <tr>
                    <td><?=$commande->getIdCommande();?></td>
                    <td><?=$commande->getReference();?></td>
                    <td><?=$commande->getPoids();?></td>
                    <td><?=$commande->getTotal();?></td>
                    <td><?=$commande->getClient()->getNom();?> <?=$commande->getClient()->getPrenom();?> </td>
                    <td><?=$commande->getAdresse()->getRue();?>, <?= !empty($commande->getAdresse()->getComplement()) ? $commande->getAdresse()->getComplement() .', ' : '' ;?> <?=$commande->getAdresse()->getCodePostal();?>, <?=$commande->getAdresse()->getVille();?> </td>
                    <td>
                        <a class="btn-modif <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=item_commande&id=<?= $commande->getIdCommande();?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td><?= $allCommandes;;?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>

<?php
$contenu = ob_get_clean();
require_once('./views/templateAdmin.php');
?>