<?php
return [
  "/" => "std/dashboard",
  "/components/settings" => "/components/settings",
  "/components/settings/developers" => "/components/settings-developers",
  "/components/notifications" => "/components/notifications",
  "/components/notifications-view/<notificationId:^([0-9]+)$>" => "/components/notifications-view"
];
?>
