<?php ob_start(); ?>

    <div class="form-style-5">
        <h2>Ajout d'un PC</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nom">Modele</label>
                    <input type="text" id="nom" name="nom" placeholder="Entrez le nom du modele...">
                </div>
                    <div>
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" placeholder="Prix">
                    </div>
                    <div>
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" placeholder="Quantité">
                    </div>
                    <div>
                        <label for="annee">Année</label>
                        <input type="date" id="date" name="date" placeholder="Date">
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <div >
                        <label for="description">Description</label>
                        <textarea  id="description" name="description" placeholder="Description ..." ></textarea>
                    </div>
                <input type="submit" name="soumis" value="Ajouter" />
            </form>
        </div>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>