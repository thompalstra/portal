<?php
namespace core\base;
class Base{

  public $_events = [];

  public function __constructor( $options = [] ){
    foreach( $options as $attributeName => $attributeValue ){
      $this->$attributeName = $attributeValue;
    }
  }
  public static function className(){
    return get_called_class();
  }

  public function dispatchEvent( \core\base\Event $event ){
    
    $dir = \Core::$app->dir;
    $ds = \Core::$app->ds;

    foreach( scandir( "{$dir}plugins{$ds}" ) as $company ){
      if( $company !== '.' && $company !== '..' ){
        foreach( scandir( "{$dir}plugins{$ds}{$company}{$ds}" ) as $plugin ){
          if( $plugin !== '.' && $plugin !== '..' ){
            if( file_exists( "{$dir}plugins{$ds}{$company}{$ds}{$plugin}{$ds}Setup.php" ) ){
              $setupClassName = "\\$company\\$plugin\\Setup";
              if( class_exists( $setupClassName ) ){
                call_user_func_array( [ $setupClassName, 'runEvent' ], [ $event ] );
              }
            }
          }
        }
      }
    }

    return $event;
  }
}
?>
