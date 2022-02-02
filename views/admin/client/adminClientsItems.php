<?php ob_start(); ?>

    <h2>Liste des clients</h2>
    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Age</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if( !empty($allClients) && is_array($allClients)){
            foreach($allClients as $client){?>
                <tr>
                    <td><?=$client->getIdClient();?></td>
                    <td><?=$client->getNom();?></td>
                    <td><?=$client->getPrenom();?></td>
                    <td><?=$client->getAge();?></td>
                    <td><?=$client->getEmail();?></td>
                    <td>
                        <a class="btn-modif <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=item_client&id=<?= $client->getIdClient();?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td><?= $allClients;;?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>

<?php
$contenu = ob_get_clean();
require_once('./views/templateAdmin.php');
?>