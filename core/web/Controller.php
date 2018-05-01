<?php
namespace core\web;
class Controller extends \core\base\Base{

  public static function name( $id ){
    return str_replace( " ", "", ucwords( str_replace( "-", " ", $id ) ) ) . 'Controller';;
  }

  public static function get( $route ){

    $path = $route[0];
    $params = $route[1];
    $parts = explode( "/", $path );

    $controllerDir = \Core::$app->environment->controllerDir;
    $controllerNs = \Core::$app->environment->controllerNs;

    $action = new \core\web\Action();

    if( !empty( $parts ) && !empty( $parts[0] ) ){
      $action->id = $parts[ count( $parts ) -1 ];
      array_pop( $parts );
    } else {
      $action->id = DEFAULT_ACTION;
    }

    if( !empty( $parts ) ){
      $controllerId = $parts[ count( $parts ) -1 ];
      array_pop( $parts );
    } else {
      $controllerId = DEFAULT_CONTROLLER;
    }

    $controllerName = self::name( $controllerId );

    $path = implode( DS, $parts );
    if( !empty( $path ) ){
      $path = "\\{$path}\\";
    } else {
      $path = "\\";
    }

    $controllerNameSpace = "{$controllerNs}{$path}{$controllerName}";

    if( class_exists( $controllerNameSpace ) ){
      $controller = new $controllerNameSpace();
      $controller->action = $action;
    } else {
      $controller = Controller::get( [ DEFAULT_CONTROLLER . "/" . DEFAULT_ACTION, $params ] );
    }
    $controller->action->params = Action::params( $controller::className(), $action->id, $params );
    var_dump( $controller->action->params ); die;
  }
  public function runError( $message, $statusCode ){
    var_dump($message); die();
  }
}
?>
