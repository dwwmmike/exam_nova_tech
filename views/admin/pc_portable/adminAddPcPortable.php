<?php ob_start(); ?>


        <div class="form-style-5">
            <h2 class="titleForm">Ajout d'un PC Portable</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de l'ordinateur...">
                    </div>
                    <div class="col">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" placeholder="Date de sortie...">
                    </div>
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" placeholder="Image">
                    </div>
                    <div class="col">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Entrez la description...">
                    </div>
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Entrez le prix...">
                    </div>

                    <div class="col">
                        <label for="quantite">Quantite</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantitée">
                    </div>
                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>