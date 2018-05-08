<?php
return [
  'log' => [
    'className' => '\core\base\Logger',
    'maxFileSize' => ( 1000 * 100 ), // in bytes
    'levels' => [ 1,2,3 ]
  ],
  'web' => [
    'environment' => [
      'className' => '\core\web\Environment',
      'default' => 'frontend'
    ],
    'security' => [
      'className' => '\core\security\Security'
    ],
    'controller' => [
      'className' => '\core\web\Controller',
      'default' => 'std',
      'layoutDefault' => 'main',
      'actionDefault' => 'index',
      'actionError' => 'error'
    ],
    'view' => [
      'className' => '\core\web\View',
      'allowedExtensions'  => [
        '.php', '.html'
      ]
    ],
    'routeHandler' => [
      'className' => '\core\web\RouteHandler'
    ],
    'routeParser' => [
      'className' => '\core\web\RouteParser'
    ]
  ]
];
?>
