<?php

namespace VillageProject\Model\Repository;

use Nette\Database\Context;
use VillageProject\Model\Village;

final class VillageRepository
{
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /** @return Village[] */
    public function getVillages(): array
    {
        $villageRows = $this->context->table('village')->fetchAll();

        $villages = [];
        foreach ($villageRows as $villageRow){
            $villages[] = new Village($villageRow->id, $villageRow->name);
        }

        return $villages;
    }

    public function addVillage(string $villageName): int
    {
        $villageRow = $this->context->table('village')->insert(['name' => $villageName]);

        return $villageRow->id;
    }
}
