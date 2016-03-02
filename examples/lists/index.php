<?php
error_reporting(E_ALL ^E_NOTICE);

try {

  define('BASE_DIR', __DIR__);
  define('APP_DIR', BASE_DIR . '/app');

  /**
   * Read the configuration
   */
  $config = include APP_DIR . '/config/config.php';

  /**
   * Autoloader
   */
  $loader = new \Phalcon\Loader();
  $loader->registerNamespaces(array(
    'PhalconExamples\Models'      => APP_DIR . '/models/',
    'PhalconExamples\Controllers' => APP_DIR . '/controllers/',
    'PhalconExamples'             => APP_DIR . '/library/',
  ))
  ->register();

  // Use composer autoloader to load vendor classes
  require_once __DIR__ . '/vendor/autoload.php';

  /**
   * Services
   */
  include APP_DIR . '/services.php';

  /**
   * Bootstrap
   */
  $application = new \Phalcon\Mvc\Application($di);

  print $application->handle()->getContent();

} catch (Exception $e) {

  print $e->getMessage() . '<br>' . nl2br(htmlentities($e->getTraceAsString()));

}
