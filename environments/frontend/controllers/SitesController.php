<?php
namespace frontend\controllers;

class SitesController{
  public function runAction( $actionId, $params = [] ){
    $actionName = "action" . str_replace( " ", "", ucwords( str_replace("-", " ", str_replace("_", " ", $actionId ) ) ) );
    if( method_exists( $this, $actionName ) ){
      call_user_func_array( [ $this, $actionName ], $params );
    } else {
      $this->runError( "Page not found" );
    }
  }
  public function actionList( $page = null, $perPage = null ){
    var_dump(" page = $page, per-page = $perPage "); die;
  }
}
?>
