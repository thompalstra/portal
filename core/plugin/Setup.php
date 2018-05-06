<?php
namespace core\plugin;
class Setup extends \core\base\Base{
  public static function runEvent( \core\base\Event $event ){
    $className = self::className();
    $events = $className::events();
    if( isset( $events[ $event->type ] ) ){
      foreach( $events[ $event->type ] as $fn ){

        \Core::$app->log( "{$className}::{$fn}( \core\base\Event \$event )", 4, true );

        call_user_func_array( [ $className, $fn ], [ $event ] );
      }
    }
  }
}
?>
