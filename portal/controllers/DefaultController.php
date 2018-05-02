<?php
namespace portal\controllers;

class DefaultController extends \core\web\Controller{
  public function actionIndex(){
    return $this->render( 'index' );
  }
  public function actionError( $exception ){
    return $this->render( "error", [
      'exception' => $exception
    ] );
  }
}

?>
