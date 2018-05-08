dash
<script>
document.addEventListener( "DOMContentLoaded", ( event ) => {
  doc.findOne( '.columns .column.main' ).load( "/components/dashboard", function( xhrEvent ) {
    console.log('success!');
  } );
} )
</script>
