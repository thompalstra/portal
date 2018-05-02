<?php
class App{

  protected $_web;

  public function __construct(){
    Core::$app = &$this;

    $requestClass =     REQUEST_CLASS;
    $sessionClass =     SESSION_CLASS;
    $controllerClass =  CONTROLLER_CLASS;
    $environmentClass = ENVIRONMENT_CLASS;

    Core::$app->_web = new \stdClass();
    Core::$app->_web->session = ( new $sessionClass() );

    Core::$app->environment = ( new $environmentClass() );
    Core::$app->request = ( new $requestClass() );
    Core::$app->controller = ( new $controllerClass() );


    header("HTTP/1.1 200 OK");
    echo Core::$app->request->handle( Core::$app->request->parse() );
  }
}

function get_partial( $fp, $data = [], $output = false ){
  $fp = str_replace( "/", DS, str_replace( "\\", DS, $fp ) );
  $environmentDir = Core::$app->environment->dir;
  $viewDir = Core::$app->controller->viewDirectory;
  $dir = DIR;
  $ds = DS;
  $extensions = ['', '.php', '.html'];
  if( $fp[0] == DS ){
    $fp = "{$environmentDir}{$fp}";
  } else {
    $fp = "{$environmentDir}{$ds}{$viewDir}{$fp}";
  }

  foreach( $extensions as $extension ){
    if( file_exists( "{$dir}{$fp}{$extension}" ) ){
      extract( $data, EXTR_PREFIX_SAME, 'data' );
      ob_start();
      require( "{$dir}{$fp}{$extension}" );
      $content = ob_get_contents();
      ob_end_clean();
    }
  }


}
?>
