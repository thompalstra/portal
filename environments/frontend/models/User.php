<?php
namespace frontend\models;
class User extends \core\base\Model{

  public $username;
  public $password;

  public function validate(){

    if( empty( $this->username ) ){
      $this->addError( "username", \Core::t( "app", "Username cannot be empty" ) );
    } else {
      if( strlen( $this->username ) < 4 ){
        $this->addError( "username", \Core::t( "app", "Username must be at least 4 characters long" ) );
      }
    }

    if( empty( $this->password ) ){
      $this->addError( "password", \Core::t( "app", "Password cannot be empty" ) );
    } else {
      if( strlen( $this->password ) < 4 ){
        $this->addError( "password", \Core::t( "app", "Password must be at least 4 characters long" ) );
      }
    }

    return empty( $this->_errors );
  }

  public function login( ){
    \Core::$app->session['username'] = $this->username;
    \Core::$app->session['password'] = $this->password;
    return true;
  }
}

?>
