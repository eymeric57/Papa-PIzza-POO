<?php

namespace App\Repository;

use Core\Repository\Repository;

class IngredientRepository extends Repository
{
    public function getTableName(): string
    {
        return 'ingredient';
    }
}
