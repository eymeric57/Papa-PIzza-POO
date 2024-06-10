<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Ingredient;
use Core\Repository\Repository;

class PizzaIngredientRepository extends Repository
{
    public function getTableName(): string
    {
        return 'pizza_ingredient';
    }

    /**
     * méthode qui récupère les ingrédients d'une pizza grace à son id
     * @param int $pizza_id
     * @return array
     */
    public function getIngredientByPizzaId(int $pizza_id):array
    {
        //on déclare un tableau vide
        $array_result = [];
        //on crée la requete SQL
        $q = sprintf(
            'SELECT * 
            FROM %1$s AS pi 
            INNER JOIN %2$s AS i ON pi.`ingredient_id` = i.`id` 
            WHERE pi.`pizza_id` = :id',
            $this->getTableName(), //correspond au %1$s
            AppRepoManager::getRm()->getIngredientRepository()->getTableName() //correspond au %2$s
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //on vérifie que la requete est bien executée
        if(!$stmt) return $array_result;

        //on execute la requete en passant l'id de la pizza
        $stmt->execute(['id' => $pizza_id]);

        //on récupère les résultats
        while($row_data = $stmt->fetch()){
            //a chaque passage de la boucle on instancie un objet ingredient
            $array_result[] = new Ingredient($row_data);
        }

        //on retourne le tableau fraichement rempli
        return $array_result;
    }
}
