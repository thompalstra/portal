<?php
namespace frontend\controllers;
use frontend\models\User;
class StdController extends \core\web\Controller{
  public function actionDashboard(){
    \Core::$app->params['title'] = \Core::t( "app", "Dashboard" );
    return $this->render( "dashboard" );
  }



  public function actionLogin(){

    $user = new User();

    \Core::$app->params['title'] = \Core::t( "app", "Login" );

    if( $_POST ){
      if( \Core::$app->security->matchCsrfToken( $_POST['_csrf'] ) ){
        if( $user->load( $_POST ) && $user->validate() ){
          if( $user->login() ){
            header("Location: /"); exit();
          } else {
            add_error( "login", \Core::t( "app", "Wrong user/password combination" ) );
          }
        } else {
          add_error( "login", \Core::t( "app", "Invalid data" ) );
        }
      } else {
        add_error( "login", \Core::t( "app", "Invalid CSRF token" ) );
      }
    }
    return $this->render( "login", [
      "user" => $user
    ] );
  }
  public function actionError( $exception ){
    return $this->render( 'error', [
      'exception' => $exception
    ] );
  }
}
?>
