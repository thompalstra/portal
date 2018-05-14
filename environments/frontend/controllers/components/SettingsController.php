<?php
namespace frontend\controllers\components;
class SettingsController extends \core\web\Controller{

  public function beforeAction( $actionId, $params = [] ){
    $result = \frontend\components\SessionValidator::isValid();
    if( $result['success'] == false ){
      if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){
        header("Content-Location: /login"); exit();
      } else {
        header("Location: /login"); exit();
      }
    }
    if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){
      header("Location: /"); exit();
    }
    
    return true;
  }

  public function actionThemes(){
    $theme = new \frontend\models\Theme( [ "params" => get_user()["theme"] ] );

    if( $_POST ) {
      if( isset( $_POST["reset"] ) ) {
        \Core::$app->session["user"]["theme"] = ( new \frontend\models\Theme() )->params;
        $success = true;
        $data = [
          "notification" => [
            "title" => [
              "img" => "/environments/frontend/assets/img/dnovo-icon.png",
              "label" => "Dnovo"
            ],
            "content" => [
              "title" => "Theme reset!",
              "description" => "Your theme has been reset",
              "img" => "/environments/frontend/assets/img/dnovo-icon.png",
            ],
            "buttons" => [
              "close" => [],
              "refresh" => [
                "data-navigate-to" => "",
                "href" => "/"
              ]
            ]
          ]
        ];
      } else if( $theme->load( $_POST ) & $theme->validate() ){
        \Core::$app->session["user"]["theme"] = $theme->params;
        $success = true;
        $data = [
          "notification" => [
            "title" => [
              "img" => "/environments/frontend/assets/img/dnovo-icon.png",
              "label" => "Dnovo"
            ],
            "content" => [
              "title" => "Theme updated",
              "description" => "Your theme has been updated",
              "img" => "/environments/frontend/assets/img/dnovo-icon.png",
            ],
            "buttons" => [
              "close" => [],
              "refresh" => [
                "data-navigate-to" => "",
                "href" => "/"
              ]
            ]
          ]
        ];
      }

      return $this->json( [
        "success" => $success,
        "data" => $data,
      ] );
    }
    return $this->renderPartial( "themes", [ "theme" => $theme ] );
  }
  public function actionDevelopers(){
    return $this->renderPartial( "developers", [
        "isDeveloper" => ( get_user()['developer'] == true )
    ] );
  }
}
