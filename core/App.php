<?php
class App{

  /**
  * EVENTS
  * route.parse.before
  * route.parse.after
  * route.handle.before
  * route.handle.after
  */

  public function __construct(){

    $this->ds = DIRECTORY_SEPARATOR;
    $this->dir = dirname( __DIR__ ) . DIRECTORY_SEPARATOR;

    include( "Core.php" );
    include( "autoload.php" );
    Core::$app = &$this;

    foreach( include( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'config.php' ) as $attributeName => $attributeValue ){
      $this->$attributeName = $attributeValue;
    }

    $environmentClass = $this->web['environment']['className'];
    $controllerClass = $this->web['controller']['className'];

    $this->environment = new $environmentClass();
    $this->controller = new $controllerClass();

    $dir = $this->dir;
    $ds = $this->ds;
    $environmentDirectory = $this->environment->directory;

    $environmentConfigPath = "{$dir}{$environmentDirectory}config{$ds}config.php";

    if( file_exists( "{$dir}{$environmentDirectory}config{$ds}config.php" ) ){
      foreach( include( "{$dir}{$environmentDirectory}config{$ds}config.php" ) as $attributeName => $attributeValue ){
        $this->$attributeName = $attributeValue;
      }
    }

    function render_partial( $fp, $data = [] ){
      $sourceFile = dirname( debug_backtrace()[0]['file'] );
      $viewClass = \Core::$app->web['view']['className'];
      ( new $viewClass() )->renderPartial( $fp, $data, $sourceFile );
    }
    $this->path = $this->url = $_SERVER['REQUEST_URI'];

    if( strpos( $this->path, '?' ) ){
      $this->path = substr( $this->path, 0, strpos( $this->path, '?' ) );
    }

    return \Core::$app->handleRoute( Core::$app->parseRoute() );
  }

  public function handleRoute( $route ){
    $routeHandlerClass = $this->web['routeHandler']['className'];
    $routeHandler = new $routeHandlerClass();
    return call_user_func_array( [ $routeHandler, 'handle' ], [ $route ] );
  }

  public function parseRoute(){
    $routeParserClass = $this->web['routeParser']['className'];
    $routeParser = new $routeParserClass();
    return call_user_func_array( [ $routeParser, 'parse' ], [  ] );
  }

  public function log( $message, $level = 4 ){
    $loggerClass = $this->log['className'];
    return call_user_func_array( [ $loggerClass, 'log' ], [ $message, $level ] );
  }
}
?>
