<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'MediaRatings\Models'      => $config->application->modelsDir,
    'MediaRatings\Controllers' => $config->application->controllersDir,
    'MediaRatings\Forms'       => $config->application->formsDir,
    'MediaRatings'             => $config->application->libraryDir
]);

$loader->register();

// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';
