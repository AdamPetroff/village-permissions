<?php

use Nette\Bridges\CacheDI\CacheExtension;
use Nette\Bridges\DatabaseDI\DatabaseExtension;
use Nette\DI\Compiler;
use Nette\DI\ContainerLoader;
use Nette\DI\Extensions\PhpExtension;

const ROOT_DIR = __DIR__ . '/../';
const TEMP_DIR = ROOT_DIR . 'temp/';
const CONFIG_DIR = ROOT_DIR . 'config/';

require __DIR__ . '/vendor/autoload.php';

$debug = true;

$loader = new ContainerLoader(TEMP_DIR, getenv('DOCKER') === 'true');
$class = $loader->load(function (Compiler $compiler) use ($debug) {
    $compiler->loadConfig(CONFIG_DIR . '/config.neon');

    $compiler->addConfig([
        'parameters' => [
            'rootDir' => ROOT_DIR,
            'tempDir' => $this->tempDir,
        ],
    ]);

    $compiler->addExtension('database', new DatabaseExtension($debug));
    $compiler->addExtension('php', new PhpExtension());
    $compiler->addExtension('cache', new CacheExtension(TEMP_DIR));
});

/** @var \Nette\DI\Container $container */
$container = new $class;

$container->initialize();

return $container;
