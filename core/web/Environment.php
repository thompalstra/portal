<?php
namespace core\web;
class Environment extends \core\base\Base{
  public function __construct(){
    $host = $_SERVER['HTTP_HOST'];
    $parts = explode( ".", $host );
    $dir = \Core::$app->dir;
    $ds = \Core::$app->ds;

    if( count( $parts ) > 2 && file_exists( "{$dir}environments{$ds}{$parts[0]}" ) ){
      $this->name = $parts[0];
    } else {
      $this->name = \Core::$app->web['environment']['default'];
    }

    $this->directory = "environments" . DIRECTORY_SEPARATOR . $this->name . DIRECTORY_SEPARATOR;
    $this->controllerDirectory = $this->directory . 'controllers' . DIRECTORY_SEPARATOR;
    $this->viewDirectory = $this->directory . 'views' . DIRECTORY_SEPARATOR;
    $this->layoutDirectory = $this->directory . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR;
  }
}
?>
