<?php
namespace core\web;
class Request extends \core\base\Base{

  public $get;
  public $post;

  public function __construct(){
    $this->get = &$_GET;
    $this->post = &$_POST;

    $this->host = $_SERVER['SERVER_NAME'];
    $this->port = !empty( $_SERVER['SERVER_PORT'] ) ? ":" . $_SERVER['SERVER_PORT'] : "";
    $this->protocol = strpos( strtolower( $_SERVER['SERVER_PROTOCOL'] ), 'https' ) ? 'https://' : 'http://';
    $this->path = isset(  $_SERVER['PATH_INFO'] ) ? substr( $_SERVER['PATH_INFO'], 1, strlen( $_SERVER['PATH_INFO'] ) ) : "";
    $this->server = "{$this->protocol}{$this->host}{$this->port}";
    $this->url = "{$this->server}{$this->path}";
  }

  public function handle( $route ){
    \Core::$app->controller = \Core::$app->controller::get( $route );
    return \Core::$app->controller->runAction( \Core::$app->controller->actionId, \Core::$app->controller->actionParams );
  }

  public function parse(){
    $params = $_GET;
    $path = $this->path;

    return [ $path, $params ];
  }
}
?>
