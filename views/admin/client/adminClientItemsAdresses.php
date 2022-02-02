<?php ob_start(); ?>

    <h2>Client <?=$client->getIdClient();?></h2>

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
        </tbody>
    </table>

    <h3>Liste des adresses</h3>

    <table class="fl-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Rue</th>
            <th>Complement</th>
            <th>Code Postal</th>
            <th>Ville</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php if(is_array($adresses)){
                foreach ($adresses as  $adresse) {
                    ?>
            <td><?=$adresse->getIdAdresse();?></td>
            <td><?=$adresse->getRue();?></td>
            <td><?=$adresse->getComplement();?></td>
            <td><?=$adresse->getCodePostal();?></td>
            <td><?=$adresse->getVille();?></td>
        </tr>
        <?php }
            } ?>
        </tbody>
    </table>

<?php
$contenu = ob_get_clean();
require_once('./views/templateAdmin.php');
?>