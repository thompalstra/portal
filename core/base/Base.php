<?php
namespace core\base;
class Base{

  public function rules(){
    return [];
  }

  public function load( $data ){
    if( isset( $data[ self::shortName() ] ) ){
      foreach( $data[ self::shortName() ] as $k => $v ){
        $this->$k = $v;
      }
    }
  }

  public static function className(){
    return get_called_class();
  }

  public static function shortName(){
    $parts = explode( "\\", get_called_class() );
    return $parts[ count( $parts ) - 1 ];
  }
  
}
?>
