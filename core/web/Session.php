<?php
namespace core\web;
class Session extends \core\base\Base{
  protected $_session;
  public function __construct(){
    session_start();
    \Core::$app->session = &$_SESSION;
  }
}
?>
