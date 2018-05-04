<?php
echo 'autoload registrered';
spl_autoload_register(function( $className ) {
  // var_dump( $className ); die;
  $ds = DIRECTORY_SEPARATOR;

  $alternates = [ "", "environments" ];

  foreach( $alternates as $alternate ){
    if( file_exists( "{$alternate}{$ds}{$className}.php" ) ){
      require "{$alternate}{$ds}{$className}.php";
    }
  }


});
?>
