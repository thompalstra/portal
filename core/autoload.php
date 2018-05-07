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
