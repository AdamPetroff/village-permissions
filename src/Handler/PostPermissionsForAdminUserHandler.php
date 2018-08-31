<?php

namespace VillageProject\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VillageProject\Model\Facade\PermissionFacade;

final class PostPermissionsForAdminUserHandler
{
    private $permissionService;

    public function __construct(PermissionFacade $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function __invoke(Request $request, int $userAdminId): Response
    {
        $requestBody = json_decode($request->getContent(), true);

        $this->permissionService->set($userAdminId, $requestBody);

        return new Response();
    }
}
