<?php

namespace VillageProject\Model\Facade;

use VillageProject\Model\Permission;
use VillageProject\Model\Repository\PermissionRestrictionRepository;
use VillageProject\Model\Repository\UserAdminRepository;
use VillageProject\Model\Repository\VillageRepository;

final class VillageFacade
{
    private $villageRepository;
    private $userAdminRepository;
    private $permissionRestrictionRepository;

    public function __construct(
        VillageRepository $villageRepository,
        UserAdminRepository $userAdminRepository,
        PermissionRestrictionRepository $permissionRestrictionRepository
    ) {
        $this->villageRepository = $villageRepository;
        $this->userAdminRepository = $userAdminRepository;
        $this->permissionRestrictionRepository = $permissionRestrictionRepository;
    }

    public function createVillage(string $villageName): int
    {
        $villageId = $this->villageRepository->addVillage($villageName);

        foreach ($this->userAdminRepository->getUserAdmins() as $userAdmin) {
            foreach (Permission::PERMISSIONS as $permission) {
                $restrictionExists = $this->permissionRestrictionRepository
                    ->permissionRestrictionForUserAdminExists($permission, $userAdmin->getId());

                if ($restrictionExists) {
                    $this->permissionRestrictionRepository->addRestriction($userAdmin->getId(), $villageId, $permission);
                }
            }
        }

        return $villageId;
    }
}