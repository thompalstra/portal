let app = function(){

}

Node.prototype._protected = {}

Document.prototype._protected.events = {
  ready: []
};

// Document.prototype._readyevents = [];

Object.defineProperty( document, 'ready', {
  get: function(){
    return this._protected.events.ready;
  },
  set: function( value ){
    this._protected.events.ready.push( value );
  }
} );

Document.prototype.on = HTMLElement.prototype.on = function( eventTypes, b, c, d ){
  eventTypes.split(" ").forEach( ( eventType ) => {
    if( typeof b === "function" ){
      this.addEventListener( eventType, b );
    } else {
      this.addEventListener( eventType, function( originalEvent ) {
        if( originalEvent.target.matches( b ) ){
          c.call( originalEvent.target, originalEvent );
        } else if( ( closest = originalEvent.target.closest( b ) ) ){
          c.call( closest, originalEvent );
        }
        if( originalEvent.defaultPrevented ){ return; }
      } );
    }
  } );
}
document.on("DOMContentLoaded", function(event){

  for( var i = 0; i < this._protected.events.ready.length; i++ ){
    if( typeof this._protected.events.ready[i] === "function" ){
      this._protected.events.ready[i].call( this, event );
      if( event.defaultPrevented ){
        break;
      }
    }
  }

  document.dispatchEvent( new CustomEvent( 'ready', {
    cancelable: true,
    bubbles: true
  } ) );
} );
