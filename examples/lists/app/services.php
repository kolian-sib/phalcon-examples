<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Register the global configuration as config
 */
$di->set('config', $config);


/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

  $view = new View();

  $view->setViewsDir(APP_DIR . '/views');

  $view->registerEngines(array(
    '.volt' => function ($view, $di) use ($config) {

      $volt = new VoltEngine($view, $di);

      // Refresh Volt cache on every request 
      array_map('unlink', glob(APP_DIR . '/cache/volt/*.php'));
      $volt->setOptions(array(
        'compileAlways' => TRUE,
      ));

      // Set compile dir
      $volt->setOptions(array(
        'compiledPath' => APP_DIR . '/cache/volt/',
        'compiledSeparator' => '_'
      ));

      $volt->getCompiler()->addFunction('sortLink', function ($resolvedArgs, $expArgs) {
        return 'TableSort\Sort::sortLink(' . $resolvedArgs . ')';
      });
      $volt->getCompiler()->addFunction('sortIcon', function ($resolvedArgs, $expArgs) {
        return 'TableSort\Sort::sortIcon(' . $resolvedArgs . ')';
      });
      $volt->getCompiler()->addFunction('paginationPath', function ($resolvedArgs, $expArgs) {
        return 'VoltHelpers\Helpers::paginationPath(' . $resolvedArgs . ')';
      });

      return $volt;
    },
    '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
  ));

  return $view;

}, true);


/**
 * Database connection
 */
$di->set('db', function () use ($config) {

  return new DbAdapter(array(
    'host' 			=> $config->database->host,
    'username'	=> $config->database->username,
    'password'	=> $config->database->password,
    'dbname'		=> $config->database->dbname
  ));

});


/**
 * Dispatcher use a default namespace.
 */
$di->set('dispatcher', function () use ($di) {

  $evManager = $di->getShared('eventsManager');
 	$evManager->attach(
    "dispatch:beforeException",
    function($event, $dispatcher, $exception) {

      switch ($exception->getCode()) {
        case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
        case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
          die($exception->getMessage());
      }
    }
  );

  $dispatcher = new Dispatcher();
  $dispatcher->setEventsManager($evManager);
  $dispatcher->setDefaultNamespace('PhalconExamples\Controllers');

  return $dispatcher;

});
