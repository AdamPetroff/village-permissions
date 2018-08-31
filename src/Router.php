<?php

namespace VillageProject;

use Silex\Application;
use VillageProject\Handler\GetVillagesHandler;
use VillageProject\Handler\PostPermissionsForAdminUserHandler;
use VillageProject\Handler\PostVillageHandler;

final class Router
{
    private $application;
    private $getVillagesHandler;
    private $postPermissionsForAdminUserHandler;
    private $postVillageHandler;

    public function __construct(
        Application $application,
        GetVillagesHandler $getVillagesHandler,
        PostPermissionsForAdminUserHandler $postPermissionsForAdminUserHandler,
        PostVillageHandler $postVillageHandler
    ) {
        $this->application = $application;
        $this->getVillagesHandler = $getVillagesHandler;
        $this->postPermissionsForAdminUserHandler = $postPermissionsForAdminUserHandler;
        $this->postVillageHandler = $postVillageHandler;
    }

    public function setRoutes(): void
    {
        $this->application->get('/user-admin/{userAdminId}/permission/{permission}/villages',
            $this->getVillagesHandler);

        $this->application->post('/user-admin/{userAdminId}/permissions',
            $this->postPermissionsForAdminUserHandler);

        $this->application->post('/village',
            $this->postVillageHandler);
    }
}
