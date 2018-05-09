<?php
namespace core\web;
class Controller extends \core\base\Base{

  public function __construct( $options = [] ){
    foreach( $options as $k => $v ){
      $this->$k = $v;
    }
  }

  public function json( $data = [] ){
    header('Content-Type: application/json');
    echo json_encode( $data );
    exit();
  }

  public function render( $fp, $data = [] ){
    $viewClass = \Core::$app->web['view']['className'];
    ( new $viewClass() )->render( $fp, $data );
  }

  public function renderPartial( $fp, $data = [] ){
    $viewClass = \Core::$app->web['view']['className'];
    ( new $viewClass() )->renderPartial( $fp, $data );
  }

  public function runAction( $actionId, $params = [] ){

    if( $this->dispatchEvent( new \core\base\Event( "action.before", [ 'context' => $this ] ) )->isPrevented ){ return; }

    $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );
    if( method_exists( $this, $actionName ) ){
      if(  method_exists( $this, 'beforeAction' ) ){
        if( call_user_func_array( [ $this, 'beforeAction' ], [ $actionId, $params ] ) !== true ){
          exit();
        }
      }
      return call_user_func_array( [ $this, $actionName ], $params );
    }
    return call_user_func_array( [ $this, 'runError' ], [ "Page not found (404.2)" ] );
  }

  public function runError( $message ){
    $environmentDirectory = \Core::$app->environment->directory;
    $environmentName = \Core::$app->environment->name;

    $controllerId = \Core::$app->web['controller']['default'];
    $actionId = \Core::$app->web['controller']['actionError'];
    $controllerName = str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $controllerId ) ) ) ) . "Controller";
    $controllerNameSpace = str_replace("/", "\\", "{$environmentName}/controllers/{$controllerName}" );
    $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );
    $path = "";

    if( class_exists( $controllerNameSpace ) && method_exists( $controllerNameSpace, 'actionError' ) ){
      \Core::$app->controller = new $controllerNameSpace( [
        'id' => $controllerId,
        'actionId' => $actionId,
        'path' => $path,
        'layout' => \Core::$app->web['controller']['layoutDefault']
      ] );
      return call_user_func_array( [ \Core::$app->controller, 'actionError' ], [ 'exception' => new \Exception( $message, 404 ) ] );
    }
    echo "Error running error"; exit();
  }
}
?>
