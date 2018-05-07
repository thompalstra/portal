document.ready = function( event ){
    document.querySelectorAll( '.togglable' ).forEach( ( node ) => {
      node.addEventListener( 'click', function( event ) {

        if( event.target.matches('a') || event.target.closest('a') ){
          return;
        }

        var target = this;

        if( node.hasAttribute('data-target') ){
          target = document.querySelector( node.getAttribute('data-target') );
        }

        if( target.classList.contains( 'show' ) ){
          target.classList.remove( 'show' );
        } else {
          target.classList.add( 'show' );
        }
      } );
    } );
    document.addEventListener( 'click', function( event ) {
      if( event.target.matches('a') || event.target.closest('a') ){
        return;
      }
      if( !event.target.matches( '.show, .togglable' ) && !( event.target.closest( '.show, .togglable' ) ) ){
        document.querySelectorAll( '.show' ).forEach( ( node ) => {
          node.classList.remove( 'show' );
        } );
      }
    } );
}
