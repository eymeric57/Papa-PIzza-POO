<?php

namespace App;

use App\Controller\AuthController;
use App\Controller\OrderController;
use App\Controller\PizzaController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

class App implements DatabaseConfigInterface
{
  //on définit des constantes
  private const DB_HOST = "database";
  private const DB_NAME = "database_lamp";
  private const DB_USER = "admin";
  private const DB_PASS = "admin";

  private static ?self $instance = null;
  //on crée une méthode public appelé au demarrage de l'appli dans index.php
  public static function getApp(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  //on crée une propriété privée pour stocker le routeur
  private Router $router;
  //méthode qui récupère les infos du routeur
  public function getRouter()
  {
    return $this->router;
  }

  private function __construct()
  {
    //on crée une instance de Router
    $this->router = Router::create();
  }

  //on a 3 méthodes a définir 
  // 1. méthode start pour activer le router
  public function start(): void
  {
    //on ouvre l'accès aux sessions
    session_start();
    //enregistrements des routes
    $this->registerRoutes();
    //démarrage du router
    $this->startRouter();
  }

  //2. méthode qui enregistre les routes
  private function registerRoutes(): void
  {
    //on va définir des patterns pour les routes
    $this->router->pattern('id', '[0-9]\d*'); //n'autorise que les chiffres



    // PARTIE AUTH:
    // connexion
    $this->router->get('/connexion', [AuthController::class, 'loginForm']);
    $this->router->post('/login', [AuthController::class, 'login']);
    $this->router->get('/inscription', [AuthController::class, 'registerForm']);
    $this->router->post('/register', [AuthController::class, 'register']);

    // PARTIE PIZZA:
    $this->router->get('/', [PizzaController::class, 'home'] );
    $this->router->get('/pizzas', [PizzaController::class, 'getPizzas'] );
    $this->router->get('/pizza/{id}', [PizzaController::class, 'getPizzaById'] );

    //PARTIE PANIER
    $this->router->post('/add/order', [OrderController::class, 'addOrder']);
    $this->router->get('/order/{id}', [OrderController::class, 'addOrder']);

  }

  //3. méthode qui démarre le router
  private function startRouter(): void
  {
    try {
      $this->router->dispatch();
    } catch (RouteNotFoundException $e) {
      echo $e;
    } catch (InvalidCallableException $e) {
      echo $e;
    }
  }

  public function getHost(): string
  {
    return self::DB_HOST;
  }

  public function getName(): string
  {
    return self::DB_NAME;
  }

  public function getUser(): string
  {
    return self::DB_USER;
  }

  public function getPass(): string
  {
    return self::DB_PASS;
  }
}
