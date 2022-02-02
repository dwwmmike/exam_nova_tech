<?php ob_start(); ?>

    <?php foreach($names as $name){?>
        <h2><?=$name->getNomType()?>s</h2>
    <?php }?>

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
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th>Quantite</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($types as $type){?>
            <tr>
                <td><?=$type->getIdComposant();?></td>
                <td><?=$type->getNomComposant();?></td>
                <td><?=$type->getPrix();?></td>
                <td><?=$type->getDescription();?></td>
                <td><?=$type->getImage();?></td>
                <td><?=$type->getQuantite();?></td>
                <?php }?>
            </tr>
        </tbody>
    </table>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
