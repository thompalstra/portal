<?php
namespace frontend\models;
class User extends \core\base\Model{

  public $username;
  public $password;
  public $theme = [
    "background" => "#f2f2f2",
    "sidebar_background" => "#222",
    "sidebar_button_background" => "#333",
    "sidebar_button_foreground" => "#fff",
    "sidebar_button_active_background" => "#ff6600",
    "sidebar_button_active_foreground" => "#fff"
  ];

  public function validate(){

    if( empty( $this->username ) ){
      $this->addError( "username", \Core::t( "app", "Username cannot be empty" ) );
    }
    if( strlen( $this->username ) < 4 ){
      $this->addError( "username", \Core::t( "app", "Username must be at least 4 characters long" ) );
    }

    if( empty( $this->password ) ){
      $this->addError( "password", \Core::t( "app", "Password cannot be empty" ) );
    }

    if( strlen( $this->password ) < 4 ){
      $this->addError( "password", \Core::t( "app", "Password must be at least 4 characters long" ) );
    }

    return empty( $this->_errors );
  }

  public function login( ){
    \Core::$app->session['user'] = [
      'username' => $this->username,
      "theme" => $this->theme,
      'developer' => false
    ];
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
