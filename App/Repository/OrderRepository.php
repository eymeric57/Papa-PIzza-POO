<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Order;
use Core\Repository\Repository;

class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return 'order';
    }

    /**
     * méthode qui permet de récupérer la dernière commande
     * @return ?int
     */
    public function findLastOrder(): ?int 
    {
        $q = sprintf(
            'SELECT * 
            FROM `%s` 
            ORDER BY id DESC 
            LIMIT 1',
            $this->getTableName()
        );

        $stmt = $this->pdo->query($q);

        if (!$stmt) return null;

        $result = $stmt->fetchObject();

        return $result->id ?? 0;
    }

    /**
     * méthode qui retourne une commande si elle est dans le panier
     * @param int $user_id
     * @param string $status
     * @return bool
     */
    public function findLastStatusByUser(int $user_id, string $status): bool
    {
        //on crée la requete SQL
        $q = sprintf(
            'SELECT * 
            FROM `%s` 
            WHERE `user_id` = :user_id 
            AND `status` = :status 
            ORDER BY id DESC 
            LIMIT 1',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);
        //on vérifie que la requete est bien executée
        if(!$stmt->execute(['user_id' => $user_id, 'status' => $status])) return false;

        //on récupère les résultats
        $result = $stmt->fetchObject();

        //si pas de resultat on retourne false
        if(!$result) return false;

        //si on a des résultats, on vérifie si la commande contient des lignes
        $count_row = $this->countOrderRow($result->id);
        //si on a pas de résultat on renvoi false
        if(!$count_row) return false;

        //si on a des résultats on renvoi true
        return true;
    }

    /**
     * méthode qui retourne le nombre de ligne de commande
     * @param int $order_id
     * @return ?int
     */
    public function countOrderRow(int $order_id): ?int
    {
        //query qui additionne le nombre de ligne de commande
        $q = sprintf(
            'SELECT SUM(quantity) as count
            FROM `%s` 
            WHERE `order_id` = :order_id',
            AppRepoManager::getRm()->getOrderRowRepository()->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //on vérifie que la requete est bien executée
        if(!$stmt->execute(['order_id' => $order_id])) return 0;

        //on récupère le résultat
        $result = $stmt->fetchObject();
        //si pas de résultat on retourne 0 sinon le nombre de ligne
        if(!$result || is_null($result)) return 0;
        return $result->count;
    }

    /**
     * méthode qui permet de créer une commande
     * @param array $data
     * @return ?int 
     */
    public function insertOrder(array $data): ?int
    {
        //on crée la requete SQL
        $q = sprintf(
            'INSERT INTO `%s` (`order_number`, `date_order`, `status`, `user_id`) 
            VALUES (:order_number, :date_order, :status, :user_id)',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //si la requete n'est pas executée on retourne null
        if(!$stmt->execute($data)) return null;

        //on retourne l'id de la commande
        return $this->pdo->lastInsertId();
    }

    /**
     * méthode qui retourne l'id de la commande si status = IN_CART pour un utilisateur
     * @param int $user_id
     * @return ?int
     */
    public function findOrderIdByStatus(int $user_id): ?int
    {
        $status = Order::IN_CART;

        //on cree la requete SQL
        $q = sprintf(
            'SELECT * 
            FROM `%s` 
            WHERE `user_id` = :user_id 
            AND `status` = :status 
            ORDER BY id DESC 
            LIMIT 1',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //on vérifie que la requete est bien executée
        if(!$stmt->execute(['user_id' => $user_id, 'status' => $status])) return null;

        //on récupère les résultats
        $result = $stmt->fetchObject();

        //si on n'a pas de résultat on retourne null
        if(!$result) return null;

        //on retourne l'id de la commande
        return $result->id;
    }
}
