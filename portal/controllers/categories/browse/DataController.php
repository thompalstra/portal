<?php
namespace portal\controllers\categories\browse;

class DataController extends \core\web\Controller{
  public function actionIndex(){
    return $this->render( 'index', [
      'a' => 'b'
    ] );
  }
}
