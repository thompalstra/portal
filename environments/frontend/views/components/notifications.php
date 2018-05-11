<div class="columns">
  <div class="column notifications-index">
    <div class="list-title">
      <h4><?=\Core::t( "app", "Notifications" )?></h4>
      <i id="reload-notifications" class="material-icons pull-right reload">refresh</i>
    </div>
    <div class='list'>
      <div class='items'>
      <?php foreach( $notifications as $notification ) : ?>
          <a data-navigate data-target=".column.notifications-view" href="/components/notifications-view/<?=$notification->id?>">
            <div class='item'>
              <span class="icon"><i class="material-icons"><?=$notification->icon?></i></span> <?=$notification->title?>
            </div>
          </a>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
  <div class="column notifications-view" data-empty-content="<?=Core::t( "app", "Nothing to display" )?>"></div>
</div>
<script>
  document.on( "click", "#reload-notifications", function( event ) {
    doc.findOne( ".column.notifications-view" ).load( "/components/notifications .column.notifications-view" ).then( function( response ) {
      return  doc.findOne( ".column.notifications-index" ).load( "/components/notifications .column.notifications-index" );
    } );
  } );
</script>
