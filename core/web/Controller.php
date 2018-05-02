<?php
namespace core\web;
class Controller extends \core\base\Base{

  public static function name( $id ){
    return str_replace( " ", "", ucwords( str_replace( "-", " ", $id ) ) ) . 'Controller';;
  }

  public static function get( $route ){

    $ds = DS;
    $dir = DIR;

    $path = $route[0];
    $params = isset( $route[1] ) ? $route[1] : [];
    $parts = explode( "/", $path );

    $controllerDir = \Core::$app->environment->controllerDir;
    $controllerNs = \Core::$app->environment->controllerNs;

    $actionId = DEFAULT_ACTION;
    $controllerId = DEFAULT_CONTROLLER;

    if( !empty( $parts ) && !empty( $parts[0] ) ){
      $actionId = $parts[ count( $parts ) -1 ];
      array_pop( $parts );
    }

    if( !empty( $parts ) ){
      $controllerId = $parts[ count( $parts ) -1 ];
      array_pop( $parts );
    }

    $controllerName = self::name( $controllerId );

    $path = implode( DS, $parts );
    if( !empty( $path ) ){
      $path = "{$path}\\";
    } else {
      $path = "";
    }

    $controllerNameSpace = "{$controllerNs}\\{$path}{$controllerName}";

    if( class_exists( $controllerNameSpace ) ){
      $controller = new $controllerNameSpace();
      $controller->id = $controllerId;
    } else {
      $controller = Controller::get( [ DEFAULT_CONTROLLER . "/" . DEFAULT_ACTION, $params ] );
      $controller->id = DEFAULT_CONTROLLER;
      $path = "";
    }
    $controller->path = $path;
    $controller->actionId = $actionId;
    $controller->viewDirectory = "views{$ds}{$controller->path}{$controller->id}{$ds}";
    $controller->actionParams = Action::params( $controller::className(), $controller->actionId, $params );

    return $controller;
  }
  public function runError( $message, $statusCode ){

    $ds = DS;
    $dir = DIR;

    header("HTTP/1.1 404 Not Found");

    $exception = new \Exception( $message, $statusCode );

    if( method_exists( $this, 'actionError' ) ) {

      \Core::$app->controller->actionId = "error";
      $path = \Core::$app->controller->path;
      $controllerId = \Core::$app->controller->id;
      \Core::$app->controller->viewDirectory = "views{$ds}{$path}{$controllerId}{$ds}";

      return $this->runAction( 'error', [ 'exception' => $exception ] );
    } else {
      \Core::$app->controller = Controller::get( [ DEFAULT_CONTROLLER . "/" . DEFAULT_ACTION ] );
      \Core::$app->controller->actionId = "error";

      if( method_exists( \Core::$app->controller, 'actionError' ) ){
        return \Core::$app->controller->runAction( 'error', [ 'exception' => $exception ] );
      }
    }
    return 'unable to process error, missing error';
  }
  public function runAction( $actionId, $params = [] ){
    $actionName = Action::getName( $actionId );
    if( method_exists( $this, $actionName ) ){
      return call_user_func_array( [ $this, $actionName ], $params );
    }
    return $this->runError( "Page $actionId not found", 404 );
  }
  public function render( $fp, $data = [] ){
    $view = new View();
    return $view->render( $fp, $data );
  }
}
?>
