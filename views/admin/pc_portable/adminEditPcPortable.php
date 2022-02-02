<?php ob_start(); ?>

<div class="form-style-5">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Modifier le PC portable</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" value="<?=$editPortable->getNom();?>">
                    </div>
        
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix" value="<?=$editPortable->getPrix();?>">
                    </div>
                    <div class="col">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité" value="<?=$editPortable->getQuantite();?>">
                    </div>
                    <div class="col">
                        <label for="annee">Année</label>
                        <input type="date" id="date" name="date" class="form-control" placeholder="Date" value="<?=$editPortable->getDate();?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" value="">
                    </div>
                    <div class="col">
                        <img src="./assets/images/<?=$editPortable->getImage();?>" alt="" width="200" class="img-thumbnail mt-2">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea  id="description" name="description" class="form-control" placeholder="Description ..." rows=""><?=$editPortable->getDescription();?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Modifier</button>
            </form>
            
          
        </div>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>
