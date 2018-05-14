<?php
namespace frontend\models;
class Theme extends \core\base\Model{

  public $params = [
    "sidebar_background" => "#222222",
    "sidebar_button_background" => "#333333",
    "sidebar_button_foreground" => "#ffffff",
    "active_background" => "#ff6600",
    "active_foregroundground" => "#ffffff"
  ];

  public function validate(){


    if( empty( $this->params["sidebar_background"] ) ){
      $this->params["sidebar_background"] = "#222222";
    }
    if( empty( $this->params["sidebar_button_background"] ) ){
      $this->params["sidebar_button_background"] = "#333333";
    }
    if( empty( $this->params["sidebar_button_foreground"] ) ){
      $this->params["sidebar_button_foreground"] = "#ffffff";
    }
    if( empty( $this->params["active_background"] ) ){
      $this->params["active_background"] = "#ff6600";
    }
    if( empty( $this->params["active_foregroundground"] ) ){
      $this->params["active_foregroundground"] = "#ffffff";
    }


    return true;
  }
}

// ID        CATEGORY              SOURCEMESSAGE
// 1         "app"                 "test"
//
// ID        SOURCE_ID             VALUE             LANGUAGE
// 1         1                     "test nl"         "nl"
// 2         1                     "test en"         "en"
?>
