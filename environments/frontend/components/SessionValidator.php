<?php
namespace frontend\components;
class SessionValidator extends \core\base\Base{
  public static function isValid(){

    $success = false;
    $message = "Session expired. Please login";

    if( isset( \Core::$app->session['username'] ) ){
      $success = true;
      $message = "Session is valid";
    }

    return [
      "success" => $success,
      "data" => [
        "message" => $message
      ]
    ];
  }
}
?>
