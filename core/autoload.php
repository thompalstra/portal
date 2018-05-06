<?php
spl_autoload_register(function( $className ) {
  $ds = DIRECTORY_SEPARATOR;
  $dir = dirname( __DIR__ ) . DIRECTORY_SEPARATOR;
  $directories = [ "", "environments", "plugins" ];
  foreach( $directories as $directory ){
    if( file_exists( "{$dir}{$directory}{$ds}{$className}.php" ) ){
      require "{$dir}{$directory}{$ds}{$className}.php";
    }
  }
});
?>
