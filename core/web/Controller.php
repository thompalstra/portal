<?php
namespace core\web;
class Controller extends \core\base\Base{

  public function __construct( $options = [] ){
    foreach( $options as $k => $v ){
      $this->$k = $v;
    }
  }

  public function render( $fp, $data = [] ){
    $viewClass = \Core::$app->web['view']['className'];
    ( new $viewClass() )->render( $fp, $data );
  }

  public function runAction( $actionId, $params = [] ){
    $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );
    if( method_exists( $this, $actionName ) ){
      return call_user_func_array( [ $this, $actionName ], $params );
    }
    var_dump( $this, $actionName ); die;
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

    if( class_exists( $controllerNameSpace ) ){
      \Core::$app->controller = new $controllerNameSpace();

      return call_user_func_array( [ \Core::$app->controller, 'runAction' ], [ $actionId, [ 'exception' => new \Exception( $message, 404 ) ] ] );
    }
    echo "Error running error"; exit();
  }
}
?>
