<?php

namespace VillageProject\Model\Repository;

use Nette\Database\Context;
use Nette\Database\UniqueConstraintViolationException;

final class PermissionRestrictionRepository
{
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /** Returns null if the record already exists */
    public function addRestriction(int $userAdminId, int $villageId, string $permission): ?int
    {
        try {
            $permissionRestrictionRow = $this->context->table('permission_restriction')->insert([
                'user_admin_id' => $userAdminId,
                'village_id' => $villageId,
                'permission' => $permission
            ]);

            return $permissionRestrictionRow->id;
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

    public function permissionRestrictionForUserAdminExists(string $permission, int $userAdminId): bool
    {
        return (bool)$this->context->table('permission_restriction')->where([
            'user_admin_id' => $userAdminId,
            'permission' => $permission
        ])->count();
    }
}
