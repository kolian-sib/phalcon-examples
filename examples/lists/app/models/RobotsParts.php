<?php
namespace PhalconExamples\Models;

use Phalcon\Mvc\Model;

class RobotsParts extends Model
{

  public $id;
  public $robots_id;
  public $parts_id;


  /**
   * Initialize
   */
  public function initialize()
  {

    // Defines a n-1 relationship
    $this->belongsTo('robots_id', 'PhalconExamples\Models\Robots', 'id');
    $this->belongsTo('parts_id', 'PhalconExamples\Models\Parts', 'id');

  }

}