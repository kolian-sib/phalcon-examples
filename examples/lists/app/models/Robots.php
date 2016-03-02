<?php
namespace PhalconExamples\Models;

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class Robots extends Model
{

  public $id;
  public $name;
  public $status;
  public $created;
  public $data;

  /**
   * Get a paginator list of robot items
   *
   * @param array $params
   * @return PaginatorQueryBuilder
   */
  public static function getList($params)
  {

    // Query defaults
    $sort = $params['sort'] ?: 'r.name';
    $order = $params['order'] ?: 'ASC';
    $page = (int) ($params['page'] ?: 1);
    $limit = $params['limit'] ?: 5;

    $builder = \Phalcon\Di::getDefault()
      ->getModelsManager()
      ->createBuilder()
      ->from(array('r' => 'PhalconExamples\Models\Robots'))
      ->where('r.status = 1')
      /* Additional join(), andWhere() and other query alters */
      ->orderBy("$sort $order");


    $paginator = new PaginatorQueryBuilder(array(
      'builder' => $builder,
      'limit' => $limit,
      'page' => $page,
    ));

    return $paginator;

  }

}