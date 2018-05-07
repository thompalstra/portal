<?php
namespace sample\controllers;
class PluginController extends \core\web\Controller{
  public function actionIndex(){

    $rest = new \sample\models\RestClient(); // this is loaded from the plugins directory

    return $this->render('/plugins/MyCompany/MyPluginName/sample/views/plugin/index');
  }
}
?>
