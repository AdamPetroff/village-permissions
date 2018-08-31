<?php

namespace VillageProject\Model;

use Nette\Database\Context;
use Nette\Database\UniqueConstraintViolationException;

class PermissionRestrictionRepository
{
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /** Returns null if the record already exists */
    public function addRestriction(int $userAdminId, int $villageId, string $permission): ?int
    {
        try{
            $this->context->table('permission_restriction')->insert([
                'user_admin_id' => $userAdminId,
                'village_id' => $villageId,
                'permission' => $permission
            ]);

            return $this->context->getInsertId();
        } catch (UniqueConstraintViolationException $e) {
            return null;
        }
    }

    public function deleteRestriction(int $userAdminId, int $villageId, string $permission): void
    {
        $this->context->table('permission_restriction')->where([
            'user_admin_id' => $userAdminId,
            'village_id' => $villageId,
            'permission' => $permission
        ])->delete();
    }
}
