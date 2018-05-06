<?php
namespace sample\controllers\user;

class SessionController extends \core\web\Controller{
  public function actionLogout(){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Plugin',
      'message' => 'Logging out...'
    ] );
  }
}
?>
