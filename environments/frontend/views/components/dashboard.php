<div class="columns">
  <div class="column" data-empty-content="<?=Core::t( "app", "Nothing to display" )?>"></div>
</div>
<?php if( $notification ) { ?>
  <script>
    new NotificationPopUp( doc.findOne( ".column.main" ), <?=json_encode( $notification )?> );
  </script>
<?php } ?>
