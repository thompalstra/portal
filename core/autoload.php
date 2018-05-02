<?php
spl_autoload_register( function( $className ) {
  $dir = DIR;
  $ds = DS;
  $ext = '.php';
  if( file_exists( "{$dir}{$className}{$ext}" ) ){
    include_once "{$dir}{$className}{$ext}";
  }
} );
?>