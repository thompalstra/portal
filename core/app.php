<?php
class App{

  protected $_web;

  public function __construct(){
    Core::$app = &$this;

    $requestClass =     REQUEST_CLASS;
    $sessionClass =     SESSION_CLASS;
    $controllerClass =  CONTROLLER_CLASS;
    $environmentClass = ENVIRONMENT_CLASS;

    Core::$app->_web = new \stdClass();
    Core::$app->_web->session = ( new $sessionClass() );

    Core::$app->environment = ( new $environmentClass() );
    Core::$app->request = ( new $requestClass() );
    Core::$app->controller = ( new $controllerClass() );

    return Core::$app->request->handle( Core::$app->request->parse() );
  }
}
?>
