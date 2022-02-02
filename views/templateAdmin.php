<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/templateAdmin.css">
  <title>Administration</title>
</head>
<body>

  <div class="sidenav">
    <div class="logo">
      <img src="./assets/images/logo.png" alt="Image du logo Nova Tech" width="120px">
    </div>
    <a href="index.php?action=logout"><i class="fas fa-sign-out-alt text-white"></i></i></i>Déconnexion</a>
    <button class="dropdown-btn"><i class="fas fa-folder-open text-white"></i></i>Composants
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <?php 
      if(isset($_SESSION) && isset($_SESSION["Auth"]) && ($_SESSION["Auth"]->id_statut == 1 || $_SESSION["Auth"]->id_statut == 2)){?>
      <a href="index.php?action=list_comp"><i class="fa fa-registered text-white" aria-hidden="true"></i>Liste des Composants</a>
      <a href="index.php?action=list_type"><i class="fa fa-registered text-white" aria-hidden="true"></i>Liste des types</a>
      <a href="index.php?action=add_comp"><i class="fa fa-registered text-white" aria-hidden="true"></i>Ajouter Composant</a>
      <a href="index.php?action=add_type"><i class="fa fa-registered text-white" aria-hidden="true"></i>Ajouter Type Composant</a>
    <?php } ?>
      </div>
    <button class="dropdown-btn"><i class="fas fa-folder-open text-white"></i></i>PC
    <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
    <a href="index.php?action=add_pc"><i class="fas fa-plus text-white"></i>Ajout</a>
    <a href="index.php?action=list_pc"><i class="fas fa-list text-white"></i>Liste</a>
  </div>
  <button class="dropdown-btn"><i class="fas fa-folder-open text-white"></i></i>Utilisateurs
    <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
  <a href="index.php?action=list_u"><i class="fa fa-registered text-white" aria-hidden="true"></i>Liste</a>
      <a href="index.php?action=add_u"><i class="fa fa-registered text-white" aria-hidden="true"></i>Ajout</a>
  </div>

  <button class="dropdown-btn"><i class="fas fa-folder-open text-white"></i></i>PC Portables
    <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
    <a href="index.php?action=list_pcp"><i class="fa fa-registered text-white" aria-hidden="true"></i>Liste</a>
    <a href="index.php?action=add_pcp"><i class="fa fa-registered text-white" aria-hidden="true"></i>Ajouter</a>
    </div>
    <button class="dropdown-btn"><i class="fas fa-folder-open text-white"></i></i>Clients
      <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
      <a href="index.php?action=list_client"><i class="fa fa-registered text-white" aria-hidden="true"></i>Liste</a>
      <a href="index.php?action=list_commandes"><i class="fa fa-registered text-white" aria-hidden="true"></i>Liste Commandes</a>
  </div>
  </div>
      </div>

    
    <div class="container mt-5">
    <div class="main">
    <h1 class="bg-dark text-center text-warning" style="border-radius: 30px;">Administration</h1>
    <?= $contenu; ?>
    </div>
  </div>
  <script src="./assets/js/templateAdmin.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 