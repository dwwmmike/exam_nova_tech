<?php ob_start(); ?>

<h2>Liste des PCs</h2>
<div class="row">
    <div class="col-4 offset-8">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group">
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
            <th>Prix</th>
            <th>Image</th>
            <th>Quantite</th>
            <th>Date</th>
            <th>Description</th>
            <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          <tr>
          <?php if(is_array($pcs)){ foreach ($pcs as  $pc) { ?>
              <td><?=$pc->getIdPcGamer();?></td>
              <td><?=$pc->getNom();?></td>
              <td><?=$pc->getPrix();?> €</td>
              <td><img src="./assets/images/<?=$pc->getImage();?>" alt="" width="100"></td>
              <td><?=$pc->getQuantite();?></td>
              <td><?=$pc->getDate();?></td>
              <td ><?=substr($pc->getDescription(),0, 19);?></td>
              <td class="text-center">
                <a class="btn-modif <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_pc&id=<?= $pc->getIdPcGamer();?>">
                    <i class="fas fa-edit"></i>
                </a>
              </td>
              <td>
                <a class="btn-supp <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_pc&id=<?= $pc->getIdPcGamer();?>"
                    onclick="return confirm('Etes vous sûr de vouloir supprimer')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
          </tr>
          <?php }} else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$pcs."</td></tr>";} ?>
      </tbody>
</table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
