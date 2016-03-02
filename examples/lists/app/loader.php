<?php
$loader = new \Phalcon\Loader();
$loader->registerNamespaces(array(
  PROJECT_NAME.'\Models'			=> $config->application->modelsDir,
  PROJECT_NAME.'\Controllers' => $config->application->controllersDir,
  PROJECT_NAME								=> $config->application->libraryDir,
))
->register();

// Use composer autoloader to load vendor classes
require_once __DIR__ . '/../../vendor/autoload.php';