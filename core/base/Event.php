<?php
namespace core\base;
class Event{

  /**
  * DEFAULT EVENTS
  * route.parse.before
  * route.parse.after
  * route.handle.before
  * route.handle.after
  * action.before
  * render.before
  * render.after
  */

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
