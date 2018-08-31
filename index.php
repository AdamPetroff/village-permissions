<?php

/** @var \Silex\Application $app */
$container = require __DIR__ . '/bootstrap.php';

/** @var \Silex\Application $app */
$app = $container->getByType(Silex\Application::class);

$app->run();
