<?php
namespace core\web;
class Action extends \core\base\Base{
  public static function params( $controllerClassName, $actionId, $params = [] ){
    $actionName = self::getName( $actionId );
    if( method_exists( $controllerClassName, $actionName ) ){
      $reflectionMethod = new \ReflectionMethod($controllerClassName, $actionName);
      $data = [];
      foreach( $reflectionMethod->getParameters() as $reflectionParameter ){
        if( isset( $params[ $reflectionParameter->name ] ) ){
          $data[] = $params[ $reflectionParameter->name ];
        }
      }

      if( count( $data ) < $reflectionMethod->getNumberOfRequiredParameters() ) {
        if( !$reflectionParameter->isOptional() && !isset( $params[ $reflectionParameter->name ] ) ){
          $missing[] = "<strong>{$reflectionParameter->name}</strong>";
        }
        return \Core::$app->controller->runError( "Missing required parameters:" . implode(", ", $missing), 500 );
      }
      return $data;
    }
  }
  public static function getName( $id ){
    return "action" . str_replace( " ", "", ucwords( str_replace( "-", " ", $id ) ) );
  }
}
?>
