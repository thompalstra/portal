<div class="columns">
  <div class="column settings">
    <h2 class="list-title">Notifications</h2>
    <div class='list'>
      <?php foreach( $notifications as $notification ) : ?>
        <div class='items'>
          <a data-navigate data-target=".column.settings-view" href="/components/notifications-view/<?=$notification->id?>">
            <div class='item'>
              <span class="icon"><i class="material-icons"><?=$notification->icon?></i></span> <?=$notification->title?>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="column settings-view">

  </div>
</div>
