<?php ob_start(); ?>

<h2>Liste des Utilisateurs</h2>
<div class="row">
    <div class="col-4 offset-8">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <div class="search">
                <input class="searchTerm" type="search" name="search" id="search" placeholder="Rechercher">
                <button type="submit" class="searchButton" name="soumis"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>
<table class="fl-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Identifiant</th>
            <th>Email</th>
            <th>Statut</th>
            <?php 
                if($_SESSION["Auth"]->id_statut == 1){?> 
            <th colspan="2" class="text-center">Action</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($allUsers as $user){?>
        <tr>
            <td><?=$user->getIdUtilisateur();?></td>
            <td><?=$user->getNom();?></td>
            <td><?=$user->getPrenom();?></td>
            <td><?=$user->getLogin();?></td>
            <td><?=$user->getEmail();?></td>
            <td><?=$user->getStatut()->getNomStatut();?></td>
            <td>
                        <a class="btn-modif <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_user&id=<?= $user->getIdUtilisateur();?>"><i class="fas fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="btn-supp <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_user&id=<?= $user->getIdUtilisateur();?>"onclick="return confirm('Etes vous sûr de vouloir supprimer')"><i class="fas fa-trash"></i></a>
                    </td>
          </tr>
            <?php }?>
        </tr>
    </tbody>
</table>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
