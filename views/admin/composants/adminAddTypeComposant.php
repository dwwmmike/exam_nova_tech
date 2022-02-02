<?php ob_start(); ?>


        <div class="form-style-5">
            <h2 class="titleForm">Ajout d'un type de composant</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div>
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom du type...">
                    </div>
                <button type="submit" name="soumis" style="border-radius: 30px;">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>