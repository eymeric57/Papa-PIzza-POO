<?php use App\Controller\OrderController;

 use Core\Session\Session;

if($auth::isAuth()) $user_id = Session::get(Session::USER)->id 


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Papa Pizza</title>
  <!-- import de la librairie bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
  <!-- import de la librairie bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- import de notre fichier de style -->
  <link rel="stylesheet" href="/style_homepage.css">
  <link rel="stylesheet" href="/style_pizza.css">
  <link rel="stylesheet" href="/auth_style.css">
</head>

<body>
  <header>
    <div id="topbar">
      <div class="line1">
        <div class="box-phone">
          <i class="bi bi-telephone"></i>
          <span>04 68 86 65 22</span>
        </div>
        <div class="box-social-icons">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>
      <div class="line2">
        <!-- 1er bloc : logo du site -->
        <div class="nav-logo">
          <a href="/">
            <img class="logo-papapizza" src="/assets/images/homepage/papapizza.svg" alt="logo Papapizza">
          </a>
        </div>
        <!-- 2eme bloc : barre de navigation -->
        <div class="nav-list">
          <nav class="custom-nav">
            <ul class="custom-ul">
              <li class="custom-link"><a href="/">Accueil</a></li>
              <li class="custom-link"><a href="/pizzas">Carte</a></li>
              <li class="custom-link"><a href="#">Actualités</a></li>
              <li class="custom-link"><a href="#">Contact</a></li>
            </ul>
          </nav>
        </div>
        <!-- 3eme bloc : menu du profil -->
        <div class="nav-profil">
          <nav class="custom-nav-profil">
            <ul class="custom-ul-profil">
              <li class="custom-link">
                <!-- si je suis en session j'affiche mon compte -->
                <?php if ($auth::isAuth()) : ?>
                  <div class="dropdown custom-link">
                    <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                      Mon compte 
                      <i class="bi bi-person custom-svg"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item custom-link" href="">Profil</a></li>
                      <li><a class="dropdown-item custom-link" href="">Créer une pizza</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item custom-link" href="">Mes pizzas</a></li>
                      <li><a class="dropdown-item custom-link" href="">Mes commandes</a></li>
                    </ul>
                  </div>
                <?php else : ?>
                  <a href="/connexion">Se connecter
                    <i class="bi bi-person custom-svg"></i>
                  </a>
                <?php endif ?>
              </li>
              <li class="custom-link">
                <?php if ($auth::isAuth()) : ?>
                  <a href="/order/<?= $user_id ?>" class="position-relative">
                  <div>
                  <i class="bi bi-cart custom-svg"></i>
                  <!--  ON verifie si on a des lignes dans le panier-->
                  <?php if(OrderController::hasOrderInCart()): ?>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                  <?php endif ?>
                  </div>


                  </a>



                <?php endif ?>

              </li>
            </ul>

          </nav>
        </div>
      </div>

    </div>
  </header>