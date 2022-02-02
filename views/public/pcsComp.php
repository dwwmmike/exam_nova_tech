<?php ob_start(); ?>

<div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./assets/images/banner.gif" class="d-block w-100 " style="height:400px" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/banner2.gif" class="d-block w-100" style="height:400px" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/banner3.gif" class="d-block w-100" style="height:400px" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
          <!---end carrousel-->
          <div class="row my-3">
              <div class="col-8">
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                    <?php foreach($figurines as $figurine){ ?>
                    <div class="col">
                      <div class="card mb-3">
                        <img src="./assets/images/<?=$figurine->getImage();?>" class="card-img-top" height="300" alt="...">
                        <div class="card-body  bg-secondary">
                          <h5 class="bg-secondary text-center text-white card-title"> <?=strtoupper($figurine->getCategorie()->getNom_cat());?>:  <?=$figurine->getNom();?></h5>
                          <p class="card-text"><?=$figurine->getDescription();?></p>
                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             Nom:
                              <span class="badge text-dark rounded-pill"><?=$figurine->getNom();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            Année:
                              <span class="badge text-dark rounded-pill"><?=$figurine->getAnnee();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             Prix:
                              <span class="badge bg-dark rounded-pill"><?=$figurine->getPrix();?> €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Quantité:
                              <span class="badge bg-dark rounded-pill"><?=$figurine->getQuantite();?></span>

                            </li>
                            <form action="index.php?action=checkout" method="post">

                                <input type="hidden" name="id" value="<?=$figurine->getId_fig();?>"/>
                                <input type="hidden" name="nom"  value="<?=$figurine->getNom();?>">
                                <input type="hidden" name="taille" value="<?=$figurine->getTaille();?>">
                                <input type="hidden" name="image" value="<?=$figurine->getImage();?>">
                                <input type="hidden" name="prix" value="<?=$figurine->getPrix();?>">
                                <input type="hidden" name="quantite" value="<?=$figurine->getQuantite();?>">
                                <?php if($figurine->getQuantite() > 0){ ?>
                                  <button type="submit" name="envoi" class="btn btn-dark col-12 mt-1">Acheter</button>
                                <?php } ?>            
                          </form> 
                          <strong class="badge col-12 rounded-pill">
                                <?php if($figurine->getQuantite() == 0){ ?>
                                <a href="index.php?action=order&id=<?=$figurine->getId_fig();?>" class="btn col-12 btn-primary text-white">
                                   Commander
                                </a>
                                <?php } ?> 
                          </strong>                                             
                          </ul>       
                        </div>
                      </div>
                    </div>
                    <?php } ?>
         
              </div>
            </div>
              <div class="col-4">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
                        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
                        <button type="submit" class="btn btn-secondary" name="soumis"><i class="fas fa-search"></i></button>
                     </form>
                <div class="card mt-1">
                    <ul class="list-group list-group-flush">
                      <?php foreach($tabCat as $cat ){ ?>
                      <li class="list-group-item text-center">
                        <a class="btn text-center" href="index.php?id=<?=$cat->getId_cat();?>"><?=ucfirst($cat->getNom_cat());?></a>
                      </li>
                     <?php } ?>
                    </ul>
                </div> 
              </div>
          
    </div>
 
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>