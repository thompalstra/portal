<?php
namespace sample\controllers\user;

class SessionController extends \core\web\Controller{
  public function actionLogout(){
    return $this->render( '/environments/sample/views/sample/dashboard', [
      'title' => 'Plugin',
      'message' => '\user\SessionController->actionLogout()'
    ] );
  }
}
?>
