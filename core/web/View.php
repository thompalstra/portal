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
      $viewFilePath = "{$dir}{$fp}";
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

    $this->file = str_replace( "/", DIRECTORY_SEPARATOR, str_replace( "\\", DIRECTORY_SEPARATOR, $file ) );
    $this->data = $data;

    if( isset( pathinfo( $file )['extension'] ) ){
      $extension = pathinfo( $file )['extension'];
      if( file_exists( $file ) ){
        $this->extension = "";
        return $this->output( $this->file, $this->extension, $this->data );
      }
      var_dump( "{$file}{$extension}" );
      return "<pre>Could not find {$file}</pre>";
    } else {
      foreach( $allowedExtensions as $extension ){
        if( file_exists( "{$file}{$extension}" ) ){
          $this->extension = $extension;
          return $this->output( $this->file, $this->extension, $this->data );
        }
      }
      $ext = "(" . implode( ", ", $allowedExtensions ) . ")";
      return "<pre>Could not find {$file} {$ext}</pre>";
    }
  }

  public function output( $file, $extension, $data ){
    $event = $this->dispatchEvent( new \core\base\Event( "render.before", [ 'context' => $this ] ) );

    extract($data, EXTR_PREFIX_SAME, 'data');
    ob_start();
    require("{$file}{$extension}");
    $content = ob_get_contents();
    ob_end_clean();

    $event = $this->dispatchEvent( new \core\base\Event( "render.after", [ 'context' => $this ] ) );

    return $content;
  }

  public function renderPartial( $fp, $data, $sourceFile = null ){

    $dir = \Core::$app->dir;
    $ds = \Core::$app->ds;

    $environmentDirectory = \Core::$app->environment->directory;
    $environmentViewDirectory = \Core::$app->environment->viewDirectory;

    if( $fp[0] == "/" || $fp[0] == "\\" ){
      $fp = trim( trim( $fp, "\\" ), "/" );
      $partialFilePath = "{$dir}{$fp}";
    } else if( !empty( $sourceFile ) ) {
      $partialFilePath = "{$sourceFile}{$ds}{$fp}";
    } else {

      $controllerPath = \Core::$app->controller->path;
      $controllerId = \Core::$app->controller->id;

      $partialFilePath = "{$dir}{$environmentViewDirectory}{$controllerPath}{$controllerId}{$ds}{$fp}";
    }

    $html = $this->renderFile( $partialFilePath, $data );

    echo $html;
  }
}
?>
