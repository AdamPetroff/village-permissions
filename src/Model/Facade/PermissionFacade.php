<?php

namespace VillageProject\Model\Facade;

use Exception;
use Nette\Database\Context;
use Symfony\Component\HttpFoundation\Response;
use VillageProject\Model\Permission;
use VillageProject\Model\Repository\PermissionRestrictionRepository;
use VillageProject\Model\Repository\VillageRepository;
use VillageProject\Model\Village;

final class PermissionFacade
{
    private $context;
    private $permissionRestrictionRepository;
    private $villageRepository;

    public function __construct(
        Context $context,
        PermissionRestrictionRepository $permissionRestrictionRepository,
        VillageRepository $villageRepository
    ) {
        $this->context = $context;
        $this->permissionRestrictionRepository = $permissionRestrictionRepository;
        $this->villageRepository = $villageRepository;
    }

    public function set(int $userAdminId, array $permissionData): void
    {
        foreach ($permissionData as $permission => $data) {
            if (!in_array($permission, Permission::PERMISSIONS)) {
                throw new Exception('Invalid permission provided', Response::HTTP_BAD_REQUEST);
            }

            foreach ($data as $villageId => $hasPermission) {
                if ($hasPermission === false) {
                    $this->permissionRestrictionRepository->addRestriction($userAdminId, $villageId,
                        $permission);
                } else {
                    $this->permissionRestrictionRepository->deleteRestriction($userAdminId, $villageId,
                        $permission);
                }
            }
        }
    }

    /** @return Village[] */
    public function get(int $userAdminId, string $permission): array
    {
        if (!in_array($permission, Permission::PERMISSIONS)) {
            throw new Exception('Invalid permission provided', Response::HTTP_BAD_REQUEST);
        }

        $permissionRestrictionRows = $this->context->table('permission_restriction')
            ->select('village_id')
            ->where([
                'user_admin_id' => $userAdminId,
                'permission' => $permission
            ]);

        $restrictedVillageIds = $permissionRestrictionRows->fetchPairs(null, 'village_id');

        $villages = [];
        foreach ($this->villageRepository->getVillages() as $village) {
            if(!in_array($village->getId(), $restrictedVillageIds)){
                $villages[] = $village;
            }
        }

        return $villages;
    }
}
