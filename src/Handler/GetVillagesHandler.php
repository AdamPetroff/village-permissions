<?php

namespace VillageProject\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use VillageProject\Model\Facade\PermissionFacade;

final class GetVillagesHandler
{
    private $permissionService;

    public function __construct(PermissionFacade $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function __invoke(Request $request, int $userAdminId, string $permission): JsonResponse
    {
        return new JsonResponse($this->permissionService->get($userAdminId, $permission));
    }
}
