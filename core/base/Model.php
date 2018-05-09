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
    if( empty( $this->_errors[ $attribute ] ) ){
      $this->_errors[ $attribute ] = [];
    }
    $this->_errors[ $attribute ][] = $message;
  }
  public function hasErrors( $attribute = null ){
    if( $attribute ){
      if( isset( $this->_errors[ $attribute ] ) ){
        return !( empty( $this->_errors[ $attribute ] ) );
      }
      return false;
    }
    return !( empty( $this->_errors ) );
  }
  public function getErrors( $attribute = null ){
    if( $attribute ){
      if( isset( $this->_errors[ $attribute ] ) ){
        return $this->_errors[ $attribute ];
      }
      return [];
    }
    return $this->_errors;
  }
  public function getFirstError( $attribute ){
    if( isset( $this->_errors[ $attribute ] ) && !empty( $this->_errors[$attribute] ) ){
      return $this->_errors[$attribute][0];
    }
    return null;
  }
}
?>
