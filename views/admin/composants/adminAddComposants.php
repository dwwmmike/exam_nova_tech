<?php ob_start(); ?>

    <div class="form-style-5">
        <h2 class="titleForm">Ajout d'un composant</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="nom_composant">Nom</label>
                <input type="text" id="nom_composant" name="nom_composant" placeholder="Nom du composant">
            </div>
            <div>
                <label for="id_type_composant">Type</label>
                <select id="id_type_composant" name="id_type_composant">
                    <option value"">Choisir un type</option>
                    <?php foreach ($tabType  as $type) { ?>
                    <option value="<?=$type->getIdTypeComposant();?>"><?=$type->getNomType();?></option>
                    <?php }; ?>
                </select>
            </div>
            <div>
                <label for="prix">Prix</label>
                <input type="text" id="prix" name="prix" placeholder="Prix...">
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="Description">
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" placeholder="Image">
            </div>
            <div>
                <label for="quantite">Quantite</label>
                <input type="number" id="quantite" name="quantite" placeholder="Quantitée">
            </div>
            <button type="submit" name="soumis">Ajouter</button>
        </form>
    </div>


<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>