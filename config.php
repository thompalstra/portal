<?php

define( "DS", DIRECTORY_SEPARATOR );
define( "DIR", __DIR__ . DIRECTORY_SEPARATOR );

define( "REQUEST_CLASS", "\core\web\Request" );
define( "ENVIRONMENT_CLASS", "\core\web\Environment" );
define( "SESSION_CLASS", "\core\web\Session" );
define( "CONTROLLER_CLASS", "\core\web\Controller" );

define( "DEFAULT_CONTROLLER", "default" );
define( "DEFAULT_ACTION", "index" );

error_reporting(-1);
ini_set("display_errors", 1);

include( DIR . "core" . DS . "autoload.php" );
include( DIR . "core" . DS . "app.php" );
include( DIR . "core" . DS . "Core.php" );

?>
