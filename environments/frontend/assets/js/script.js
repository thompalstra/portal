document.addEventListener( "DOMContentLoaded", ( event ) => {
  doc.on( "click", "[data-navigate][href]", function( event ) {
      event.preventDefault();
      var target = this;
      if( this.hasAttribute('data-target') ){
        target = doc.findOne( this.getAttribute('data-target') );
      }
      var url = this.getAttribute('href');

      target.load( url, function( event ) {
      } );
  } );

  doc.on( "ajax.progress.update", function( event ) {
    progressElement = doc.findOne('.progress-indicator .progress-value');
    progressElement.style['width'] = event.progress + "%";
    if( event.progress == 100 ){
      progressElement.style['transition'] = 'none';
      progressElement.style['width'] = '0%';
      progressElement.style['transition'] = '';
    }
  } );
} );
