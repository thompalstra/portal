<div class="columns">
  <div class="column notifications-index">
    <h2 class="list-title position-relative">
      Notifications <i id="reload-notifications" class="material-icons pull-right reload">refresh</i>
    </h2>
    <div class='list'>
      <?php foreach( $notifications as $notification ) : ?>
        <div class='items'>
          <a data-navigate data-target=".column.notifications-view" href="/components/notifications-view/<?=$notification->id?>">
            <div class='item'>
              <span class="icon"><i class="material-icons"><?=$notification->icon?></i></span> <?=$notification->title?>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="column notifications-view" data-empty-content="Nothing to see here"></div>
</div>
<script>
  document.on( "click", "#reload-notifications", function( event ) {
    doc.findOne( ".column.notifications-view" ).load( "/components/notifications .column.notifications-view", function( event ) {
      doc.findOne( ".column.notifications-index" ).load( "/components/notifications .column.notifications-index", function( event ) {

      } )
    } )

  } );
</script>
