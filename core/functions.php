<?php

function render_partial( $fp, $data = [] ){
  $sourceFile = dirname( debug_backtrace()[0]['file'] );
  $viewClass = \Core::$app->web['view']['className'];
  ( new $viewClass() )->renderPartial( $fp, $data, $sourceFile );
}

function get_image( $fp ){
  $dir = \Core::$app->dir;
  $ds = \Core::$app->ds;
  $environmentDirectory = \Core::$app->environment->directory;
  if( $fp[0] == "/" || $fp[0] == "\\" ){
    return "{$fp}";
  }
  return "/{$environmentDirectory}assets/img/{$fp}";
}

function get_upload( $fp ){
  $dir = \Core::$app->dir;
  $ds = \Core::$app->ds;
  $environmentDirectory = \Core::$app->environment->directory;

  if( $fp[0] == "/" || $fp[0] == "\\" ){
    return "{$fp}";
  }
  return "/{$environmentDirectory}assets/upload/{$fp}";
}

?>
