<?php ob_start(); ?>

<h2>Liste des PC Portables</h2>
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
          <?php if(is_array($pcps)){ foreach ($pcps as  $pcp) { ?>
              <td><?=$pcp->getIdPcPortable();?></td>
              <td><?=$pcp->getNom();?></td>
              <td><?=$pcp->getPrix();?> €</td>
              <td><img src="./assets/images/<?=$pcp->getImage();?>" alt="" width="100"></td>
              <td><?=$pcp->getQuantite();?></td>
              <td><?=$pcp->getDate();?></td>
              <td ><?=substr($pcp->getDescription(),0, 19);?></td>
              <td class="text-center">
                <a class="btn-modif <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_pcp&id=<?= $pcp->getIdPcPortable();?>">
                    <i class="fas fa-edit"></i>
                </a>
              </td>
              <td>
                <a class="btn-supp <?= ( ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 )) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_pcp&id=<?= $pcp->getIdPcPortable();?>"
                    onclick="return confirm('Etes vous sûr de vouloir supprimer')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
          </tr>
          <?php }} else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$pcps."</td></tr>";} ?>
      </tbody>
</table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
