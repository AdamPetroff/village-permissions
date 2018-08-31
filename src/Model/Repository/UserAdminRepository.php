<?php

namespace VillageProject\Model\Repository;

use Nette\Database\Context;
use VillageProject\Model\UserAdmin;
use VillageProject\Model\Village;

final class UserAdminRepository
{
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /** @return UserAdmin[] */
    public function getUserAdmins(): array
    {
        $userAdminRows = $this->context->table('user_admin')->fetchAll();

        $userAdmins = [];
        foreach ($userAdminRows as $userAdminRow) {
            $userAdmins[] = new UserAdmin($userAdminRow->id, $userAdminRow->name);
        }

        return $userAdmins;
    }
}
