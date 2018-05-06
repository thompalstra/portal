<?php
namespace sample\controllers;

class NotificationsController extends \core\web\Controller{
  public function actionView( $notification ){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Notifications',
      'message' => "Managing notification '{$notification}'"
    ] );
  }
  public function actionViewError( $notification ){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Notifications',
      'message' => "Could not find notification '{$notification}'"
    ] );
  }
  public function actionList( $page = null, $perPage = null ){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Notifications',
      'message' => "Listing notifications. Page = '$page', per-page = '$perPage'"
    ] );
  }
}
?>
