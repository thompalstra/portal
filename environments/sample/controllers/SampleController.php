<?php
namespace sample\controllers;
class SampleController extends \core\web\Controller{
  public function actionDashboard(){
    return $this->render( 'dashboard', [
      'title' => 'dashboard',
      'message' => "Ran route to the Dashboard"
    ] );
  }
  public function actionError( $exception ){
    return $this->render( 'dashboard', [
      'title' => "SampleController->actionError( \$exception exception )",
      "message" => $exception->getMessage()
      ] );
  }
  public function actionMyRouteComponent( $data ){
    return $this->render( 'dashboard', [
      'title' => 'RouteComponent',
      'message' => "Ran route via RouteComponent with data \$data = `$data'"
    ] );
  }
}
?>
