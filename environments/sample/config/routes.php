<?php
return [
  [ '\sample\components\RouteComponent' => [
      'a' => 'a',
      'b' => 'b'
  ] ],
  "/notifications/<notificationId:^([0-9]+)$>" => "notifications/view",
  "/notifications/<notificationId:^(.*)$>" => "notifications/view-error",
  "/sites/<siteName:^([a-zA-Z0-9-]+_[a-z]+)$>" => "sites/view",
  "/sites/list" => "/site/list",
  "/sites/list/<page:^([0-9]+)$>/<per-page:^([0-9]+)$>" => "sites/list",
  "/sites/list/<page:^([0-9]+)$>" => "sites/list",
  "/sites/<siteName:^(.*)$>" => "sites/view-error"
];
?>
