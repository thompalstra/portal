<?php
namespace sample\controllers;

class NotificationsController extends \core\web\Controller{
  public function actionView( $notificationId ){
    return $this->render( '/environments/sample/views/sample/dashboard', [
      'title' => 'Notifications',
      'message' => "Managing notification '{$notificationId}'"
    ] );
  }
  public function actionViewError( $notificationId ){
    return $this->render( '/environments/sample/views/sample/dashboard', [
      'title' => 'Notifications',
      'message' => "Could not find notification '{$notificationId}'"
    ] );
  }
  public function actionList( $page = null, $perPage = null ){
    return $this->render( '/environments/sample/views/sample/dashboard', [
      'title' => 'Notifications',
      'message' => "Listing notifications. Page = '$page', per-page = '$perPage'"
    ] );
  }
}
?>
