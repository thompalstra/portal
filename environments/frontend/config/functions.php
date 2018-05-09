<?php
function has_user(){
  if( isset( \Core::$app->session['user'] ) ){
    return true;
  }
  return false;
}
function get_user(){
  return \Core::$app->session['user'];
}

\Core::$app->_errors = [];

function add_error( $category, $message ){
  if( !isset( \Core::$app->_errors[$category] ) ){
    \Core::$app->_errors[$category] = [];
  }
  \Core::$app->_errors[$category][] = $message;
}
function has_errors( $category = null ){
  if( $category && isset( \Core::$app->_errors[$category] ) ){
    return ( isset( \Core::$app->_errors[$category] ) && !empty( \Core::$app->_errors[$category] ) );
  }
  return \Core::$app->_errors;
}
function get_errors( $category = null ){
  if( $category ){
    if( isset( \Core::$app->_errors[$category] ) && !empty( \Core::$app->_errors[$category] ) ){
      return \Core::$app->_errors[$category];
    } else {
      return [];
    }
  }
  return \Core::$app->_errors;
}
?>
