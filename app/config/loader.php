<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Turmeric\Controllers' => $config->application->controllersDir,
    'Turmeric\Forms'       => $config->application->formsDir,
    'Turmeric\Models'      => $config->application->modelsDir,
    'Turmeric\Elements'    => $config->application->elementsDir,
    'Turmeric'             => $config->application->libraryDir
]);

$loader->register();

// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';