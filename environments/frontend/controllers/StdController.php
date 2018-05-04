<?php
namespace frontend\controllers;

class StdController{
  public function runAction( $actionId, $params = [] ){
    $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );
    if( method_exists( $this, $actionName ) ){
      call_user_func_array( [ $this, $actionName ], $params );
    } else {
      $this->runError( "Page not found" );
    }
  }
  public function actionDashboard(){
    var_Dump("this is the dashobard"); die;
  }
  public function actionError( $exception ){
    var_dump($exception); die;
  }
}
?>
