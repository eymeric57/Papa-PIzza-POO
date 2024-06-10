<?php

namespace App;

use App\Model\Order;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Repository\IngredientRepository;
use App\Repository\OrderRowRepository;
use App\Repository\PizzaIngredientRepository;
use App\Repository\PizzaRepository;
use App\Repository\PriceRepository;
use App\Repository\SizeRepository;
use App\Repository\UnitRepository;
use Core\Repository\RepositoryManagerTrait;

class AppRepoManager
{
  //on récupère le trait RepositoryManagerTrait
  use RepositoryManagerTrait;

  //on déclare une propriété privée qui va contenir une instance du repository
  private IngredientRepository $ingredientRepository;
  private OrderRepository $orderRepository;
  private OrderRowRepository $orderRowRepository;
  private PizzaIngredientRepository $pizzaIngredientRepository;
  private PizzaRepository $pizzaRepository;
  private PriceRepository $priceRepository;
  private SizeRepository $sizeRepository;
  private UnitRepository $unitRepository;
  private UserRepository $userRepository;

  //on crée le getter
  public function getUserRepository(): UserRepository
  {
    return $this->userRepository;
  }

  public function getIngredientRepository(): IngredientRepository
  {
    return $this->ingredientRepository;
  }

  public function getOrderRepository(): OrderRepository
  {
    return $this->orderRepository;
  }

  public function getOrderRowRepository(): OrderRowRepository
  {
    return $this->orderRowRepository;
  }

  public function getPizzaIngredientRepository(): PizzaIngredientRepository
  {
    return $this->pizzaIngredientRepository;
  }

  public function getPizzaRepository(): PizzaRepository
  {
    return $this->pizzaRepository;
  }

  public function getPriceRepository(): PriceRepository
  {
    return $this->priceRepository;
  }

  public function getSizeRepository(): SizeRepository
  {
    return $this->sizeRepository;
  }

  public function getUnitRepository(): UnitRepository
  {
    return $this->unitRepository;
  }

  //on declare un construct qui va instancier les repositories
  protected function __construct()
  {
    $config = App::getApp();
    //on instancie le repository
    $this->userRepository = new UserRepository($config);
    $this->ingredientRepository = new IngredientRepository($config);
    $this->orderRepository = new OrderRepository($config);
    $this->orderRowRepository = new OrderRowRepository($config);
    $this->pizzaIngredientRepository = new PizzaIngredientRepository($config);
    $this->pizzaRepository = new PizzaRepository($config);
    $this->priceRepository = new PriceRepository($config);
    $this->sizeRepository = new SizeRepository($config);
    $this->unitRepository = new UnitRepository($config);
  }
}
