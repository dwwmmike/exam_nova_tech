<?php ob_start(); ?>

    <h2>Liste des Composants</h2>
    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <div class="search">
            <input class="searchTerm" type="search" name="search" id="search" placeholder="Rechercher">
            <button class="searchButton" type="submit" name="soumis"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th>Quantite</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($allComps as $component){?>
                <tr>
                    <td><?=$component->getIdComposant();?></td>
                    <td><?=$component->getNomComposant();?></td>
                    <td><?=$component->getTypeComposant()->getNomType();?></td>
                    <td><?=$component->getPrix();?></td>
                    <td><?=$component->getDescription();?></td>
                    <td><img src="./assets/images/<?=$component->getImage();?>" alt="" width="70"></td>
                    <td><?=$component->getQuantite();?></td>
                    <td class="text-center">
                <a class="btn-modif <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_comp&id=<?= $component->getIdComposant();?>">
                    <i class="fas fa-edit"></i>
                </a>
              </td>
              <td>
                <a class="btn-supp <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_comp&id=<?= $component->getIdComposant();?>"
                    onclick="return confirm('Etes vous sûr de vouloir supprimer')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
                </tr>
            <?php }?>
        </tbody>
    </table>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
