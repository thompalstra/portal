<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("autoload.php");
?>
<pre>
<a href="/">dashboard</a>
<a href="/this-does-not-match">this does not match</a>
<a href="/notifications/99">notification 99</a>
<a href="/notifications/ad">notification AD</a>

<a href="/sites/my-valid-site_com">my-valid-site_com</a>
<a href="/sites/my-invalid-site">my-invalid-site</a>
<a href="/sites/list/25">sites list page</a>
<a href="/sites/list/2/33">sites list page, pagesize</a>

<?php

$uri = $_SERVER['REQUEST_URI'];

$routes = [
  // "/" => "std/dashboard",
  "/" => "std/dashboard",
  "/notifications/<notificationId:^([0-9]+)$>" => "/notifications/view",
  "/notifications/<notificationId:^(.*)$>" => "/notifications/view-error",
  "/sites/<siteName:^([a-zA-Z0-9-]+_[a-z]+)$>" => "/sites/view",
  "/sites/list" => "/site/list",
  "/sites/list/<page:^([0-9]+)$>/<per-page:^([0-9]+)$>" => "/sites/list",
  "/sites/list/<page:^([0-9]+)$>" => "/sites/list",
  "/sites/<siteName:^(.*)$>" => "/sites/view-error"
];
class Core{
  public static $app;
}
class App{

}
class Environment{
  public function __construct(){
    $host = $_SERVER['HTTP_HOST'];
    $parts = explode( ".", $host );

    if( count( $parts ) > 1 ){
      $this->name = $parts[0];
    } else {
      $this->name = Core::$app->web['environmentDefault'];
    }

    $this->directory = "environments" . DIRECTORY_SEPARATOR . $this->name . DIRECTORY_SEPARATOR;
  }
}

Core::$app = new App();
Core::$app->web = [
  'environmentDefault' => 'frontend',
  'controllerDefault' => 'std',
  'actionDefault' => 'index',
  'actionError' => 'error'
];
Core::$app->environment = new Environment();

$route = match( $routes, $uri );

function match( $routes, $uri  ){

  $controllerDefault = Core::$app->web['controllerDefault'];
  $actionDefault = Core::$app->web['actionDefault'];
  $actionError = Core::$app->web['actionError'];

  foreach( $routes as $match => $target ){

    $match = trim( $match, "/" );
    $uri = trim( $uri, "/" );

    $matchParts = explode("/", $match);
    $uriParts = explode("/", $uri);

    $score = 0;
    $requiredScore = count( $uriParts );

    $params = [];

    if( count( $matchParts ) == count( $uriParts ) ){
      foreach( $matchParts as $matchIndex => $matchPart ){
        if( isset( $matchParts[$matchIndex][0] ) && $matchParts[$matchIndex][0] == '<' ){
          $filter = explode(":", trim( trim( $matchParts[$matchIndex], "<" ), ">" ) );
          if( preg_match(  "/{$filter[1]}/", $uriParts[$matchIndex] ) ){
            $params[$filter[0]] = $uriParts[$matchIndex];
            $score++;
          }
        } else if( $matchParts[$matchIndex] == $uriParts[$matchIndex] ){
          $score++;
        }
      }
    }

    if( $score == $requiredScore ){
      $_GET = $_GET + $params;
      return [ $target, $params ];
    }
  }
  return [ "{$controllerDefault}/{$actionError}", [ 'exception' => new \Exception( "Page not found", 404 ) ] ];
}

handle( $route );

function handle( $route ){

  $environmentDirectory = Core::$app->environment->directory;
  $environmentName = Core::$app->environment->name;

  $parts = explode( "/", trim( $route[0], "/" ) );

  if( count( $parts ) > 0 ){
    $actionId = $parts[ count( $parts ) - 1 ];
    array_pop($parts);
  } else {
    $actionId = Core::$app->web['actionDefault'];
  }

  if( count( $parts ) > 0 ){
    $controllerId = $parts[ count( $parts ) - 1 ];
    array_pop($parts);
  } else {
    $controllerId = Core::$app->web['controllerDefault'];
  }

  if( count( $parts ) > 0 ){
    $path = implode("/", $parts) . "/";
  } else {
    $path = "";
  }

  $controllerName = str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $controllerId ) ) ) ) . "Controller";
  $controllerNameSpace = str_replace("/", "\\", "{$environmentName}/controllers/{$path}{$controllerName}" );
  $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );

  $params = [];
  foreach( $route[1] as $k => $v ){
    $params[] = "\${$k} = '$v'";
  }
  $params = implode(", ", $params );
  echo "<strong>Route management completed.</strong>\r\n";
  var_dump( "Running {$controllerNameSpace}->$actionName($params)" );
  if( class_exists( $controllerNameSpace ) ){
    $c = new $controllerNameSpace();
    call_user_func_array( [ $c, 'runAction' ], [ $actionId, $route[1] ] );
  } else {
    runError( "Page not found" );
  }
}

function runError( $message ){

  $environmentDirectory = Core::$app->environment->directory;
  $environmentName = Core::$app->environment->name;

  $controllerId = Core::$app->web['controllerDefault'];
  $actionId = Core::$app->web['actionError'];
  $controllerName = str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $controllerId ) ) ) ) . "Controller";
  $controllerNameSpace = str_replace("/", "\\", "{$environmentName}/controllers/{$controllerName}" );
  $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );

  if( class_exists( $controllerNameSpace ) ){
    $c = new $controllerNameSpace();
    call_user_func_array( [ $c, 'runAction' ], [ $actionId, [ 'exception' => new Exception( $message, 404 ) ] ] );
  } else {
    echo "Error running error";
  }


}

?>
