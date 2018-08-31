<?php

namespace VillageProject\Model;

use Nette\Database\Context;

class VillageRepository
{
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /** @return Village[] */
    public function getVillagesExcept(array $villageIds): array
    {
        $villageRows = $this->context->table('village')
            ->where('id NOT IN (?)', $villageIds ?: [0]);

        $villages = [];
        foreach ($villageRows as $villageRow){
            $villages[] = new Village($villageRow->id, $villageRow->name);
        }

        return $villages;
    }
}
