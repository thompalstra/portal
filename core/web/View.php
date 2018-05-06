<?php
namespace core\web;
class View extends \core\base\Base{
  public function render( $fp, $data = [] ){

    $dir = \Core::$app->dir;
    $ds = \Core::$app->ds;

    $environmentViewDirectory = \Core::$app->environment->viewDirectory;
    $environmentLayoutDirectory = \Core::$app->environment->layoutDirectory;
    $environmentDirectory = \Core::$app->environment->directory;

    $controllerPath = \Core::$app->controller->path;
    $controllerId = \Core::$app->controller->id;
    $layoutName = \Core::$app->controller->layout;

    if( $fp[0] == "/" || $fp[0] == "\\" ){
      $fp = trim( trim( $fp, "\\" ), "/" );
      $viewFilePath = "{$dir}{$environmentDirectory}{$fp}";
    } else {
      $viewFilePath = "{$dir}{$environmentViewDirectory}{$controllerPath}{$controllerId}{$ds}{$fp}";
    }

    $layoutFilePath = "{$dir}{$environmentLayoutDirectory}{$layoutName}";

    $html = $this->renderFile( $layoutFilePath, [
      'view' => $this->renderFile( $viewFilePath, $data )
    ] );

    echo $html;
    exit();
  }
  public function renderFile( $file, $data ){
    $allowedExtensions = \Core::$app->web['view']['allowedExtensions'];

    $file = str_replace( "/", DIRECTORY_SEPARATOR, str_replace( "\\", DIRECTORY_SEPARATOR, $file ) );
    // var_dump( pathinfo( $file )['extension'] ); die;

    if( isset( pathinfo( $file )['extension'] ) ){
      $extension = pathinfo( $file )['extension'];
      if( file_exists( "{$file}{$extension}" ) ){
        extract($data, EXTR_PREFIX_SAME, 'data');
        ob_start();
        require("{$file}{$extension}");
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
      }
      return "<pre>Could not find {$file}</pre>";
    } else {
      foreach( $allowedExtensions as $extension ){
        if( file_exists( "{$file}{$extension}" ) ){
          extract($data, EXTR_PREFIX_SAME, 'data');
          ob_start();
          require("{$file}{$extension}");
          $content = ob_get_contents();
          ob_end_clean();
          return $content;
        }
      }
      $ext = "(" . implode( ", ", $allowedExtensions ) . ")";
      return "<pre>Could not find {$file} {$ext}</pre>";
    }
  }
  public function renderPartial( $fp, $data, $sourceFile ){

    $dir = \Core::$app->dir;
    $ds = \Core::$app->ds;

    $environmentDirectory = \Core::$app->environment->directory;


    if( $fp[0] == "/" || $fp[0] == "\\" ){
      $fp = trim( trim( $fp, "\\" ), "/" );
      $partialFilePath = "{$dir}{$fp}";
    } else {
      $partialFilePath = "{$sourceFile}{$ds}{$fp}";
    }

    $html = $this->renderFile( $partialFilePath, $data );

    echo $html;
  }
}
?>
