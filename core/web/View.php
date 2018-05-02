<?php
namespace core\web;

class View extends \core\base\Base{
  public function render( $view, $data = [] ){
    $view = self::getViewPath( $view );
    $layout = self::getLayoutPath( "main" );
    return $this->renderPartial( $layout, [
      "content" => $this->renderPartial( $view, $data )
    ] );
  }
  public function renderPartial( $fp, $data = [] ){
    $nfp = self::getPath( $fp );
    if( !empty ( $nfp ) ){
      extract( $data, EXTR_PREFIX_SAME, 'data' );
      ob_start();
      require( $nfp );
      $content = ob_get_contents();
      ob_end_clean();
      return $content;
    } else {
      echo "{$fp} does not exist";
      return NULL;
    }
  }
  public static function getViewPath( $fp ){
    $dir = DIR;
    $ds = DS;

    $viewDirectory = \Core::$app->controller->viewDirectory;
    $environmentDirectory = \Core::$app->environment->dir;
    $actionId = \Core::$app->controller->actionId;
    return "{$dir}{$environmentDirectory}{$ds}{$viewDirectory}{$actionId}";
  }
  public static function getLayoutPath( $fp ){
    $dir = DIR;
    $ds = DS;

    $environmentDirectory = \Core::$app->environment->dir;

    return "{$dir}{$environmentDirectory}{$ds}layouts{$ds}{$fp}";
  }

  public static function getPath( $fp ){

    $extensions = [ "", ".php", ".html" ];

    foreach( $extensions as $extension ){
      if( file_exists( "{$fp}{$extension}" ) ){
        return "{$fp}{$extension}";
      }
    }
    return null;
  }
}
?>
