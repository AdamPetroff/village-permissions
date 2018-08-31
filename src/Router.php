<?php

namespace VillageProject;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VillageProject\Model\PermissionService;

class Router
{
    private $permissionService;
    private $application;

    public function __construct(Application $application, PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
        $this->application = $application;
    }

    public function setRoutes()
    {
        $permissionService = $this->permissionService;

        $this->application->get('/user-admin/{userAdminId}/permission/{permission}/villages',
            function (Request $request, int $userAdminId, string $permission) use ($permissionService) {
                return new JsonResponse($permissionService->get($userAdminId, $permission));
            }
        );

        $this->application->post('/user-admin/{userAdminId}/permissions',
            function (Request $request, int $userAdminId) use ($permissionService) {
                $requestBody = json_decode($request->getContent(), true);

                $permissionService->set($userAdminId, $requestBody);

                return new Response();
            }
        );
    }
}
