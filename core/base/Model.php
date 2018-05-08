<?php
namespace core\base;
class Model extends \core\base\Base{

  public $_errors = [];

  public function load( $data ){
    if( isset( $data[ self::shortName() ] ) ){
      foreach( $data[ self::shortName() ] as $attr => $val ){
        $this->$attr = $val;
      }
      return true;
    }
    return false;
  }
  public function addError( $attribute, $message ){
    if( empty( $this->_errors[$attribute] ) ){
      $this->_errors[$attribute] = [];
    }
    $this->_errors[$attribute][] = $message;
  }
  public function hasErrors(){
    return !empty( $this->_errors );
  }
  public function getErrors(){
    return $this->_errors;
  }
}
?>
