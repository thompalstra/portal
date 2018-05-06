<?php
namespace sample\controllers;
class SitesController extends \core\web\Controller{
  public function actionView( $site ){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Sites',
      'message' => "Managing site `{$site}`"
    ] );
  }
  public function actionViewError( $site ){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Sites',
      'message' => "Could not find site `{$site}`"
    ] );
  }
  public function actionList( $page = null, $perPage = null ){
    return $this->render( '/views/sample/dashboard', [
      'title' => 'Sites',
      'message' => "Listing sites. Page = '$page', per-page = '$perPage'"
    ] );
  }
}
?>
