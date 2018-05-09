dashboard


<?php if( $notification ) { ?>
<script>
  new NotificationPopUp( doc.findOne( ".column.main" ), <?=json_encode( $notification )?> );
</script>

<?php } ?>
