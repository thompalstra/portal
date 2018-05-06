<?php
namespace core\base;
class Event{

  public $isPrevented = false;

  public function __construct( $type, $options = [] ){
    $this->type = $type;
    foreach( $options as $k => $v ){
      $this->$k = $v;
    }
  }
  public function preventDefault(){
    $this->isPrevented = true;
  }
}
?>
