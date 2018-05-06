<?php
namespace core\web;
class RouteParser extends \core\base\Base{
  public static function parse(){
    $event = $this->dispatchEvent( new \core\base\Event( "route.parse.before", [] ) );
    if( $event->isPrevented ){
      return;
    }

    $uri = \Core::$app->path;

    $controllerDefault = \Core::$app->web['controller']['default'];
    $actionDefault = \Core::$app->web['controller']['actionDefault'];
    $actionError = \Core::$app->web['controller']['actionError'];
    $environmentDirectory = \Core::$app->environment->directory;

    $ds = \Core::$app->ds;
    $dir = \Core::$app->dir;
    $routes = [];

    if( file_exists( "{$dir}{$environmentDirectory}config{$ds}routes.php" ) ){
      $routes = include( "{$dir}{$environmentDirectory}config{$ds}routes.php" );
    }

    foreach( $routes as $match => $target ){

      if( is_array( $target ) ){
        // run component
        reset($target);
        $componentClass = key($target);
        $arguments = $target[$componentClass];
        if( class_exists( $componentClass ) ){
          $route = call_user_func_array( [ $componentClass, 'parse' ], [ $uri, $arguments ] );
          if( !empty( $route ) ){
            return $route;
          }
        }
      } else {
        // run string match and regex match
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
    }

    $event = $this->dispatchEvent( new \core\base\Event( "route.parse.after", [] ) );

    if( $event->isPrevented ){
      return;
    }

    $parts = explode( "/", $uri );

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

    return [ "{$path}{$controllerId}/{$actionId}" , []];
  }
}
?>
