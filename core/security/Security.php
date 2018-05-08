<?php
namespace core\security;
class Security extends \core\base\Base{
  public function generateCsrfToken(){
    return md5(uniqid(rand(), TRUE));
  }
  public function getCsrfToken(){
    if( !isset( \Core::$app->session['_csrf'] ) ){
      \Core::$app->session['_csrf'] = [
        'token' => $this->generateCsrfToken(),
        'timeout' => time() + (1000 * 100)
      ];
    }


    if( time() < \Core::$app->session['_csrf']['timeout'] ){
      return \Core::$app->session['_csrf']['token'];
    } else {
      return Core::$app->session['_csrf'] = [
        'token' => $this->generateCsrfToken(),
        'timeout' => time() + (1000 * 100)
      ];
    }
  }
  public function matchCsrfToken( $csrfToken ){
    return ( $this->getCsrfToken() == $csrfToken );
  }
}
?>
