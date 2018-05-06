<?php
namespace MyCompany\MyPluginName;
class Setup extends \core\plugin\Setup{
  public static function events(){
    return [
      'route.parse.before' => ['parseRouteBefore'],
      'route.parse.after' => ['parseRouteAfter'],
      'route.handle.before' => ['handleRouteBefore'],
      'route.handle.after' => ['handleRouteAfter']
    ];
  }
  public static function parseRouteBefore( \core\base\Event $event ){
    if( \Core::$app->path == '/logout' ){
      \Core::$app->path = '/user/session/logout';
    }
  }
  public static function parseRouteAfter( \core\base\Event $event ){
  }
  public static function handleRouteBefore( \core\base\Event $event ){
  }
  public static function handleRouteAfter( \core\base\Event $event ){
  }
}
?>
