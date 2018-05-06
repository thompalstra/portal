<?php
namespace core\web;
class RouteHandler extends \core\base\Base{
  public static function handle( $route ){
    if( $this->dispatchEvent( new \core\base\Event( "route.handle.before", [] ) )->isPrevented ){ return; }

    $environmentDirectory = \Core::$app->environment->directory;
    $environmentName = \Core::$app->environment->name;

    $parts = explode( "/", trim( $route[0], "/" ) );

    if( count( $parts ) > 0 && !empty( $parts[ count( $parts ) - 1 ] ) ){
      $actionId = $parts[ count( $parts ) - 1 ];
      array_pop($parts);
    } else {
      $actionId = \Core::$app->web['controller']['actionDefault'];
    }
    if( count( $parts ) > 0 && !empty( $parts[ count( $parts ) - 1 ] ) ){
      $controllerId = $parts[ count( $parts ) - 1 ];
      array_pop($parts);
    } else {
      $controllerId = \Core::$app->web['controller']['default'];
    }

    if( count( $parts ) > 0 && !empty( $parts[ count( $parts ) - 1 ] ) ){
      $path = implode("/", $parts) . "/";
    } else {
      $path = "";
    }

    $controllerName = str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $controllerId ) ) ) ) . "Controller";
    $controllerNameSpace = str_replace("/", "\\", "{$environmentName}/controllers/{$path}{$controllerName}" );
    $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );



    if( $this->dispatchEvent( new \core\base\Event( "route.handle.after", [] ) )->isPrevented ){ return; }

    if( class_exists( $controllerNameSpace ) ){
      \Core::$app->controller = new $controllerNameSpace( [
        'id' => $controllerId,
        'actionId' => $actionId,
        'path' => $path,
        'layout' => \Core::$app->web['controller']['layoutDefault']
      ] );
      return call_user_func_array( [ \Core::$app->controller, 'runAction' ], [ $actionId, $route[1] ] );
    }
    return call_user_func_array( [ \Core::$app->controller, 'runError' ], [ "Page not found (404.1)" ] );
  }

}
?>
