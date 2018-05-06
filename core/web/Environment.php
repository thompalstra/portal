<?php
namespace core\web;
class Environment extends \core\base\Base{
  public function __construct(){
    $host = $_SERVER['HTTP_HOST'];
    $parts = explode( ".", $host );

    if( count( $parts ) > 2 ){
      $this->name = $parts[0];
    } else {
      $this->name = \Core::$app->web['environment']['default'];
    }

    $this->directory = "environments" . DIRECTORY_SEPARATOR . $this->name . DIRECTORY_SEPARATOR;
    $this->controllerDirectory = $this->directory . 'controllers' . DIRECTORY_SEPARATOR;
    $this->viewDirectory = $this->directory . 'views' . DIRECTORY_SEPARATOR;
    $this->layoutDirectory = $this->directory . 'layouts' . DIRECTORY_SEPARATOR;
  }
}
?>
