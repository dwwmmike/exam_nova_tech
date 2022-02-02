<?php ob_start(); ?>
<div class="form-style-5">
    <h2>Modifier <?=$editComp->getNomComposant();?></h2>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" value="<?=$editComp->getNomComposant();?>">
            </div>
            <div>
                <label for="prix">Prix</label>
                <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix" value="<?=$editComp->getPrix();?>">
            </div>
            <div>
                <label for="quantite">Quantité</label>
                <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité" value="<?=$editComp->getQuantite();?>">
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control" value="">
            </div>
            <div>
                <img src="./assets/images/<?=$editComp->getImage();?>" alt="" width="200" class="img-thumbnail mt-2">
            </div>
        
            <div>
                <label for="description">Description</label>
                <textarea  id="description" name="description" class="form-control" placeholder="Description ..." rows=""><?=$editComp->getDescription();?></textarea>
            </div>
        <button type="submit" name="soumis" style="border-radius: 30px;">Modifier</button>
    </form>
</div>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>
