<?php ob_start(); ?>

<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Modifier le PC <?=$editPc->getNom();?></h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="" enctype="multipart/form-data">

                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" value="<?=$editPc->getNom();?>">
                    </div>
        
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix" value="<?=$editPc->getPrix();?>">
                    </div>
                    <div class="col">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité" value="<?=$editPc->getQuantite();?>">
                    </div>
                    <div class="col">
                        <label for="annee">Année</label>
                        <input type="date" id="date" name="date" class="form-control" placeholder="Date" value="<?=$editPc->getDate();?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" value="">
                    </div>
                    <div class="col">
                        <img src="./assets/images/<?=$editPc->getImage();?>" alt="" width="200" class="img-thumbnail mt-2">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea  id="description" name="description" class="form-control" placeholder="Description ..." rows=""><?=$editPc->getDescription();?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Modifier</button>
            </form>
            
          
        </div>
        <hr/>
        <div class="col-8 offset-2">
            <h3>Liste des composants</h3>

                <table class="fl-table">
                    <thead>
                    <tr>
                        <td>Type Composant</td>
                        <td>Nom Composant</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($editPc->getComposants() as $composant) { ?>
                    <tr>
                        <td><?= $composant->getTypeComposant()->getNomType(); ?></td> 
                        <td><?= $composant->getNomComposant(); ?></td> 
                        <td><a href="index.php?action=delete_pc_gamer_composant&id_composant=<?=$composant->getIdComposant()?>&id=<?=$editPc->getIdPcGamer();?>">Supprimer<a/></td>
                     </tr>
                    <?php } ?>
                    </tbody>
                </table>


                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col">
                    <?php foreach($composantByType as $type => $composants) { ?>
                    <?= $type ?>
                        <select class="form-control" name="composant[]">
                            <option disabled=true selected=true> Ajouter un composant</option>
                            <?php foreach ($composants as $comp) { ?>
                                <option value="<?= $comp->getIdComposant(); ?>"> <?= $comp->getNomComposant(); ?></option>
                          <?php  } ?>
                        </select>    
                        <?php  } ?>                
                    </div>
                </div>
                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumisComposant" style="border-radius: 30px;">Ajouter</button>

                </form>
            </div>
    </div>
</div>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>
