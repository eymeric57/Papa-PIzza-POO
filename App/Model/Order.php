<?php 

namespace App\Model;

use Core\Model\Model;

class Order extends Model
{
    //en attente au panier
    const IN_CART = 'cart';
    //validation panier
    const VALIDATED = 'validated';
    //en attente
    const PENDING = 'pending';
    //en cours de préparation
    const PREPARING = 'preparing';
    //en cours de livraison
    const DELIVERED = 'delivered';
    //annulée
    const CANCELED = 'canceled';
     

    public string $order_number;
    public string $date_order;
    public ?string $date_delivered;
    public string $status;
    public int $user_id;

    //propriété d'hydratation
    public ?User $user;

    public array $order_rows;
}