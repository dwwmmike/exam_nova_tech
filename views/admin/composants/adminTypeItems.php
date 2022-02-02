<?php ob_start(); ?>

    <h2>Liste des types de composants</h2>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($types as $type){?>
                <tr>
                    <td><?=$type->getIdTypeComposant();?></td>
                    <td><?=$type->getNomType();?></td>
                    <td>
                        <a class="btn-modif <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_type&id=<?= $type->getIdTypeComposant();?>"><i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="btn-supp <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_type&id=<?= $type->getIdTypeComposant();?>"onclick="return confirm('Etes vous sûr de vouloir supprimer')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>