<?php
namespace frontend\controllers;
class StdController extends \core\web\Controller{
  public function actionDashboard(){
    \Core::$app->params['title'] = \Core::t( "app", "Dashboard" );
    return $this->render( "dashboard" );
  }
  public function actionLogin(){
    \Core::$app->params['title'] = \Core::t( "app", "Login" );
    $this->layout = "login";
    return $this->render( "login" );
  }
  public function actionError( $exception ){
    return $this->render( 'error', [
      'exception' => $exception
    ] );
  }
}
?>
