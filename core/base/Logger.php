<?php
namespace core\base;
class Logger extends \core\base\Base{
  public static function log( $message, $level = 4, $data = [] ){
    if( array_search( $level, \Core::$app->log['levels'] ) !== false ){

      $fileName = self::getFileName();
      
      if( !is_dir( dirname( $fileName ) ) ){
        mkdir( dirname( $fileName ), 777, true );
      }

      $handle = fopen( $fileName, "a" ) or die("Unable to open file!");
      $time = date( "Y-m-d h:i:s" );
$message = '{
  "time":'.json_encode( $time ).',
  "message":' . json_encode( $message ) . ',
  "level":'. json_encode( $level ) . '
  "data":'. json_encode( $data ) . '
},';

      // $message = json_encode( $message );

      fwrite( $handle, "$message \r\n" );
      fclose( $handle );
    }
  }
  public static function getFileName(  ){
    $dir = \Core::$app->dir;
    $ds = \Core::$app->ds;

    $stamp = date( "Y-m-d" );

    $year = date( "Y" );
    $month = date( "m" );
    $day = date( "d" );

    $fileName = "{$dir}logs{$ds}{$year}{$ds}{$month}{$ds}{$day}{$ds}";
    $fileNameAddition = "0000";
    $fileNameExtension = "log";
    $maxFileSize = isset( \Core::$app->log['maxFileSize'] ) ? \Core::$app->log['maxFileSize'] : ( 1000 * 10 );

    $counter = 0;
    while( file_exists( $fileName . "{$fileNameAddition}.{$fileNameExtension}" ) && ( ( filesize( $fileName . "{$fileNameAddition}.{$fileNameExtension}" ) >= $maxFileSize ) ) ){
      $counter++;
      if( $counter < 10 ){
        $fileNameAddition = "000" . $counter;
      } else if( $counter < 100 ){
        $fileNameAddition = "00" . $counter;
      } else if( $counter < 1000 ){
        $fileNameAddition = "0" . $counter;
      }
    }

    return $fileName . "{$fileNameAddition}.{$fileNameExtension}";
  }
}

?>
