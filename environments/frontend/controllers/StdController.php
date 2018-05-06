<?php
namespace frontend\controllers;
class StdController extends \core\web\Controller{
  public function actionDashboard(){
    return $this->render( 'dashboard' );
  }
}
?>
