<?php
namespace MyCompany\MyPluginName;
class Setup extends \core\plugin\Setup{
  public static function events(){
    return [
      'route.parse.before' => ['parseRouteBefore'],
      'route.parse.after' => ['parseRouteAfter'],
      'route.handle.before' => ['handleRouteBefore'],
      'route.handle.after' => ['handleRouteAfter'],
      'action.before' => ['actionBefore'],
      'render.before' => ['renderBefore'],
      'render.after' => ['renderAfter'],
    ];
  }
  public static function parseRouteBefore( \core\base\Event $event ){
    if( \Core::$app->path == '/logout' && \Core::$app->environment->name == 'sample' ){
      \Core::$app->path = '/user/session/logout';
    }
  }
  public static function parseRouteAfter( \core\base\Event $event ){
  }
  public static function handleRouteBefore( \core\base\Event $event ){
  }
  public static function handleRouteAfter( \core\base\Event $event ){
  }
  public static function actionBefore( \core\base\Event $event ){
  }
  public static function renderBefore( \core\base\Event $event ){
  }
  public static function renderAfter( \core\base\Event $event ){
  }
}
?>
