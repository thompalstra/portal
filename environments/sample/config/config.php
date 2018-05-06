<?php
return [
  'log' => [
    'className' => '\core\base\Logger',
    'maxFileSize' => ( 1000 * 100 ), // in bytes
    'levels' => [ 1,2,3,4 ]
  ],
  'web' => [
    'environment' => [
      'className' => '\core\web\Environment',
      'default' => 'frontend'
    ],
    'controller' => [
      'className' => '\core\web\Controller',
      'default' => 'sample',
      'layoutDefault' => 'main',
      'actionDefault' => 'dashboard',
      'actionError' => 'error'
    ],
    'view' => [
      'className' => '\core\web\View',
      'allowedExtensions'  => [
        '', '.php', '.html'
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
