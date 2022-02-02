<?php ob_start();?>

<div class="container">
  <h2 class="text-white text-center bg-dark mt-2">Ma commande</h2>
<div class="row">
  <div class="col-8">
    <div class="card mb-3" >
      <div class="row g-0">
        <div class="col-md-4">
          <img src="./assets/images/<?=$image;?>" width="50%" alt="..." >
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title text-end"><?=$nom;?>-<?=$taille;?>cm</h5>
            <p class="card-text text-end">Prix: <?=$prix;?> €</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-3">
  <h4 class="text-center">Validation</h4>
    <form>
      <label for="email" class="text-white">Email*</label>
      <input type="email"id="email" class="form-control" placeholder="Votre email...">
      <label for="quant" class="text-white">Quantite*</label>
      <input type="number" id="quant" class="form-control" min="1" value="1" max="<?=$nb;?>">
      <input type="hidden" id="ref" value="<?=$id;?>">
      <input type="hidden" id="nom" value="<?=$nom;?>">
      <input type="hidden" id="taille" value="<?=$taille;?>">
      <input type="hidden" id="prix" value="<?=$prix;?>">
      <input type="hidden" id="nb" value="<?=$nb;?>">
      <button id="checkout-button" class="btn btn-dark col-12 mt-2">
      <i class="fab fa-cc-visa"></i> Valider
      </button>
    </form>
  </div>
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>