<?php
spl_autoload_register(function( $className ) {

  $ds = DIRECTORY_SEPARATOR;
  $dir = dirname( __DIR__ ) . DIRECTORY_SEPARATOR;
  $directories = [ "", "environments", "plugins" ];

  foreach( $directories as $directory ){
    $fp = str_replace( "\\", $ds, str_replace( "/", $ds, "{$dir}{$directory}{$ds}{$className}.php" ) );
    if( file_exists( $fp) ){
      require $fp;
    }
  }

  if( is_dir( "{$dir}plugins" ) ){
    foreach( scandir( "{$dir}plugins{$ds}" ) as $companyName ){
      if( $companyName !== '.' && $companyName !== '..' ){
        foreach( scandir( "{$dir}plugins{$ds}{$companyName}{$ds}" ) as $pluginName ){
          if( $pluginName !== '.' && $pluginName !== '..' ){
            if( file_exists( "{$dir}plugins{$ds}{$companyName}{$ds}{$pluginName}{$ds}{$className}.php" ) ){
              require "{$dir}plugins{$ds}{$companyName}{$ds}{$pluginName}{$ds}{$className}.php";
            }
          }
        }
      }
    }
  }
});
?>
