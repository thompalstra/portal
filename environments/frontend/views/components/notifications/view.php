<div class="list-title">
  <i class="material-icons pull-right unload" data-unload data-target=".column.notifications-view">arrow_back</i>
  <h4><?=\Core::t( "app", "Back" )?></h4>
</div>
<div class="notification m-1">
  <h2 class="p-0 m-0"><?=$notification->title?></h2>
  <?=$notification->description?>
</div>
