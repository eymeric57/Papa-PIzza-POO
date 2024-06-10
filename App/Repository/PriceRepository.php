<?php

namespace App\Repository;

use App\Model\Size;
use App\Model\Price;
use App\AppRepoManager;
use Core\Repository\Repository;

class PriceRepository extends Repository
{
    public function getTableName(): string
    {
        return 'price';
    }

    /**
     * méthode qui permet de récupérer le prix d'une pizza grace à son id avec sa taille associée
     * @param int $pizza_id
     * @return array
     */
    public function getPriceByPizzaId(int $pizza_id):array 
    {
        //on déclare un tableau vide
        $array_result = [];
        //on crée la requete SQL
        $q = sprintf(
            'SELECT p.*, s.`label` 
            FROM %1$s AS p 
            INNER JOIN %2$s AS s ON p.`size_id` = s.`id`
            WHERE p.`pizza_id` = :id',
            $this->getTableName(), //correspond au %1$s
            AppRepoManager::getRm()->getSizeRepository()->getTableName() //correspond au %2$s
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //on vérifie que la requete est bien executée
        if (!$stmt) return $array_result;

        //on execute la requete en passant l'id de la pizza
        $stmt->execute(['id' => $pizza_id]);

        //on récupère les résultats
        while ($row_data = $stmt->fetch()) {
            //a chaque passage de la boucle on instancie un objet ingredient
            $price = new Price($row_data);

            //on va reconstruire à la main un tableau pour crée une instance de Size
            $size_data = [
                'id' => $row_data['size_id'],
                'label' => $row_data['label']
            ];

            //on peut maintenant instancier un objet Size
            $size = new Size($size_data);

            //on va hydrater Price avec Size
            $price->size = $size;

            //on rempli le tableau avec l'objet Price
            $array_result[] = $price;
        }

        //on retourne le tableau fraichement rempli
        return $array_result;
    }
}
