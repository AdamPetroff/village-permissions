<?php

namespace VillageProject\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VillageProject\Model\Facade\VillageFacade;

final class PostVillageHandler
{
    private $villageFacade;

    public function __construct(VillageFacade $villageFacade)
    {
        $this->villageFacade = $villageFacade;
    }

    public function __invoke(Request $request)
    {
        $requestBody = json_decode($request->getContent(), true);

        $villageId = $this->villageFacade->createVillage($requestBody['name']);

        return new JsonResponse(['villageId' => $villageId], Response::HTTP_CREATED);
    }
}