<?php 

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Session\Session;
use Core\View\View;

class PizzaController extends Controller
{
  /**
   * méthode qui renvoie la vue de la page d'accueil
   * @return void
   */
  public function home()
  {
    //preparation des données à transmettre à la vue
    

    $view = new View('home/home');
    $view->render();
  }

  /**
   * méthode qui renvoie la vue de la liste des pizzas
   * @return void
   */
  public function getPizzas():void
  {
    //le controlleur doit récupérer le tableau de pizzas pour le donnée à la vue
    $view_data = [
      'h1' => 'Notre carte',
      'pizzas' => AppRepoManager::getRm()->getPizzaRepository()->getAllPizzas()
    ];

    $view = new View('home/pizzas');
    $view->render($view_data);
  }

  /**
   * méthode qui renvoie la vue d'une pizza grace à son id
   * @param int $id
   * @return void
   */
  public function getPizzaById(int $id):void
  {

    $view_data = [
      'pizza' => AppRepoManager::getRm()->getPizzaRepository()->getPizzaById($id),
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];


    $view = new View('home/pizza_detail');
    $view->render($view_data);
  }

}