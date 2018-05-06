<?php
namespace sample\components;
class RouteComponent extends \core\web\RouteComponent{
  public static function parse( String $uri ){
    if( $uri == '/my-route-component' ){
      return ['/my-route-component', [ 'data' => 'test' ]];
    }
  }
}
?>
