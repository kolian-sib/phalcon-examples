<?php
namespace PhalconExamples\Controllers;

use Phalcon\Mvc\Controller;
use PhalconExamples\Models\Robots;

/**
 * RobotsController
 *
 * @package PhalconExamples\Controllers
 */
class RobotsController extends Controller
{

  /**
   * View a list of robots
   */
  public function indexAction()
  {

    $params = $this->request->getQuery();
    $this->view->pager = Robots::getList($params);

  }

}