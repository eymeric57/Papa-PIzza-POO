<?php

namespace App\Repository;

use Core\Repository\Repository;

class OrderRowRepository extends Repository
{
    public function getTableName(): string
    {
        return 'order_row';
    }

    /**
     * méthode qui permet d'ajouter une ligne de commande
     * @param array $data
     * @return bool
     */
    public function insertOrderRow(array $data): bool 
    {
        //on crée la requete SQL
        $q = sprintf(
            'INSERT INTO `%s` (`order_id`, `pizza_id`, `quantity`, `price`) 
            VALUES (:order_id, :pizza_id, :quantity, :price)',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);

        if(!$stmt->execute($data)) return false;

        return true;
    }
}
