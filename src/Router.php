<?php

namespace VillageProject;

use Silex\Application;
use VillageProject\Handler\GetVillagesHandler;
use VillageProject\Handler\PostPermissionsForAdminUserHandler;

final class Router
{
    private $application;
    private $getVillagesHandler;
    private $postPermissionsForAdminUserHandler;

    public function __construct(
        Application $application,
        GetVillagesHandler $getVillagesHandler,
        PostPermissionsForAdminUserHandler $postPermissionsForAdminUserHandler
    ) {
        $this->application = $application;
        $this->getVillagesHandler = $getVillagesHandler;
        $this->postPermissionsForAdminUserHandler = $postPermissionsForAdminUserHandler;
    }

    public function setRoutes()
    {
        $this->application->get('/user-admin/{userAdminId}/permission/{permission}/villages',
            $this->getVillagesHandler);

        $this->application->post('/user-admin/{userAdminId}/permissions',
            $this->postPermissionsForAdminUserHandler);
    }
}
