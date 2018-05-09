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
  public function generateToken( $length = 32, $separator = "-", $groupSize = 4, $ranges = [] ){

    if( empty( $ranges ) ){
      $ranges = [
        [ "0", '9' ],
        [ "a", "z" ],
        [ "A", "Z" ]
      ];
    }

    $charset = [];

    foreach( $ranges as $range ){
      $charset = array_merge( $charset, range( $range[0], $range[1] ) );
    }

    $count = 0;
    $output = "";

    while( $count < $length ){
      $output .= $charset [ rand( 0, count( $charset ) - 1 ) ];
      $count++;
    }

    $outputs = []; $count = 0;

    while( $count < $length ){
      $outputs[] = substr( $output, $count, $groupSize );
      $count += $groupSize;
    }

    if( $separator ){
      return implode( $separator, $outputs );
    }
    return implode( "", $outputs );


  }
}
?>
