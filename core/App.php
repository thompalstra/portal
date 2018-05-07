<?php
class App{

  public $params = [
    'title' => 'My page'
  ];

  public function __construct(){

    $this->ds = DIRECTORY_SEPARATOR;
    $this->dir = dirname( __DIR__ ) . DIRECTORY_SEPARATOR;

    include( "Core.php" );
    include( "autoload.php" );
    Core::$app = &$this;

    foreach( include( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'config.php' ) as $attributeName => $attributeValue ){
      $this->$attributeName = $attributeValue;
    }

    \Core::$app->getConfigurations();

    $environmentClass = $this->web['environment']['className'];
    $controllerClass = $this->web['controller']['className'];

    $this->environment = new $environmentClass();
    $this->controller = new $controllerClass();

    \Core::$app->getFunctions();

    $this->path = $this->url = $_SERVER['REQUEST_URI'];

    if( strpos( $this->path, '?' ) ){
      $this->path = substr( $this->path, 0, strpos( $this->path, '?' ) );
    }

    return \Core::$app->handleRoute( Core::$app->parseRoute() );
  }
  public function getFunctions(){

    $dir = $this->dir;
    $ds = $this->ds;
    $environmentDirectory = $this->environment->directory;

    if( file_exists( "{$dir}core{$ds}functions.php" ) ){
      include( "{$dir}core{$ds}functions.php" );
    }
    if( file_exists( "{$dir}{$environmentDirectory}config{$ds}functions.php" ) ){
      include( "{$dir}{$environmentDirectory}config{$ds}functions.php" );
    }
  }

  public function getConfigurations(){

    $dir = $this->dir;
    $ds = $this->ds;

    if( file_exists( "{$dir}config.php" ) ){
      foreach( include( "{$dir}config.php" ) as $attributeName => $attributeValue ){
        $this->$attributeName = $attributeValue;
      }
    }

    $parts = explode( ".", $_SERVER['HTTP_HOST'] );
    $environmentName = ( count( $parts ) > 2 ) ? $parts[0] : \Core::$app->web['environment']['default'];
    $environmentDirectory = "environments" . DIRECTORY_SEPARATOR . $environmentName . DIRECTORY_SEPARATOR;

    if( file_exists( "{$dir}{$environmentDirectory}config{$ds}config.php" ) ){
      foreach( include( "{$dir}{$environmentDirectory}config{$ds}config.php" ) as $attributeName => $attributeValue ){
        $this->$attributeName = $attributeValue;
      }
    }
  }

  public function handleRoute( $route ){
    $routeHandlerClass = $this->web['routeHandler']['className'];
    $routeHandler = new $routeHandlerClass();

    \Core::$app->log( "Handling route", 1, [
        'route' => $route
    ] );

    return call_user_func_array( [ $routeHandler, 'handle' ], [ $route ] );
  }

  public function parseRoute(){
    $routeParserClass = $this->web['routeParser']['className'];
    $routeParser = new $routeParserClass();

    \Core::$app->log( "Parsing route", 1 );

    return call_user_func_array( [ $routeParser, 'parse' ], [  ] );
  }

  public function log( $message, $level = 4, $data = [] ){
    $loggerClass = $this->log['className'];
    return call_user_func_array( [ $loggerClass, 'log' ], [ $message, $level, $data ] );
  }
}
?>
