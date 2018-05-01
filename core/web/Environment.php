<?php
namespace core\web;
class Environment extends \core\base\Base{
  public $name;
  public $dir;
  public function __construct(){
    $this->name = 'portal';
    $this->dir = $this->name;
    $this->controllerDir = $this->dir . DS . 'controllers';
    $this->controllerNs = "\\" . str_replace( "/", "\\", $this->controllerDir );
    $this->viewDir = $this->dir . DS . 'views';
  }
}
?>
