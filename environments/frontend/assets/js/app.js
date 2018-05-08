let app = function(){

}

if( typeof window['_'] === "undefined" ){ window['_'] = app; }
if( typeof window['$'] === "undefined" ){ window['$'] = app; }
if( typeof window['doc'] === "undefined" ){ window['doc'] = document; }

let extend = function(){
  return {
    targets: arguments,
    with: function( extensions, forceProperty ){
      for( var targetIndex = 0; targetIndex < this.targets.length; targetIndex++ ){
        var target = ( this.targets[targetIndex].prototype && forceProperty !== true ) ? this.targets[targetIndex].prototype : this.targets[targetIndex];

        for( var extensionIndex in extensions ){
          target[extensionIndex] = extensions[extensionIndex];
        }
      }
    }
  };
}
var derp = {

};


extend( app ).with( {
  defaults: {
    xhr: {
      method: "GET",
      url: location.href,
      responseType: 'document',
      data: {},
      requestHeaders: []
    }
  },
  xhr: {
    req: null,
    createXhrObject: function( obj ){
      if( typeof obj == "string" ){
        obj = {
          url: obj
        };
      }

      if( !obj.hasOwnProperty( "onsuccess" ) ){
        obj.onsuccess = function(){}
      }
      if( !obj.hasOwnProperty( "onerror" ) ){
        obj.onerror = function(){}
      }
      if( !obj.hasOwnProperty( "onalways" ) ){
        obj.onalways = function(){}
      }
      if( !obj.hasOwnProperty( "method" ) ){
        obj.method = app.defaults.xhr.method;
      }
      if( !obj.hasOwnProperty( "url" ) ){
        obj.url = app.defaults.xhr.url;
      }
      if( !obj.hasOwnProperty( "requestHeaders" ) ){
        obj.requestHeaders = app.defaults.xhr.requestHeaders;
      }

      if( !obj.hasOwnProperty( "responseType" ) ){
        obj.responseType = app.defaults.xhr.responseType;
      }

      if( !obj.hasOwnProperty( "data" ) ){
        obj.data = app.defaults.xhr.data;
      }

      return obj;
    },
    send: function( obj ){
      var obj = app.xhr.createXhrObject( obj );
      if( app.xhr.req ){
        app.xhr.req.abort();
      }

      var xhr = app.xhr.req = new XMLHttpRequest();

      xhr.obj = obj;
      xhr.open( xhr.obj.method, xhr.obj.url );
      xhr.responseType = xhr.obj.responseType;

      xhr.setRequestHeader( "X-Requested-With", "XMLHttpRequest" );

      for( var header in xhr.obj.requestHeaders ){
        xhr.setRequestHeader( header, xhr.obj.requestHeaders[header] );
      }
      xhr.onreadystatechange = function( event ){
        if( this.getResponseHeader( "Content-Location" ) ){
          console.log("Redirect from XML request using Content-Location header.");
          location.href = this.getResponseHeader( "Content-Location" );
          return;
        }
        if( this.readyState == 4 ){
          app.xhr.req = null;
          if( this.status == 200 ){
            this.obj.onsuccess.call( this, this.response, this, event );
          } else {
            this.obj.onerror.call( this, event );
          }
          this.obj.onalways.call( this, event );
        }
      }.bind( xhr );
      xhr.onerror = xhr.obj.onerror;
      xhr.send( xhr.obj.data );
    }
  },
  post: function( obj ){

  },
  get: function( obj ){

  }
}, true )

extend( Document, HTMLElement, derp ).with( {
  findOne: function( q ){
    return this.querySelector( q );
  },
  findAll: function( q ){
    return this.querySelectorAll( q );
  },
  do: function( eventType, options ){
    var event = new CustomEvent( eventType, {
      cancelable: true,
      bubbles: true
    } );
    for( var i in options ){
      event[i] = options[i];
    }

    this.dispatchEvent( event );
  },
  on: function( eventTypes, b, c, d ){
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
  },
  load: function( url, onsuccess ){

    doc.do( "ajax.progress.update", { progress: "15" } );

    app.xhr.send( {
      url: url,
      onsuccess: function( response, xhr, event ){
        doc.do( "ajax.progress.update", { progress: "33" } );
        this.innerHTML = response.head.innerHTML + response.body.innerHTML;
        doc.do( "ajax.progress.update", { progress: "66" } );
        this.findAll( 'script' ).forEach( ( originalScriptElement ) => {
          var newScriptElement = this.appendChild(  document.createElement( 'script' ) );
          newScriptElement.innerHTML = originalScriptElement.innerHTML;
          originalScriptElement.remove();
        } );
        doc.do( "ajax.progress.update", { progress: "75" } );
        if( typeof onsuccess === "function" ){
          onsuccess.call( this, response, xhr, event );
        }
        doc.do( "ajax.progress.update", { progress: "100" } );
      }.bind( this )
    } );
  }
} );

extend( NodeList ).with( {
  on: function(){
    this.delegate( "on", arguments );
  },
  delegate: function( type, arguments ){
    for( var elementIndex = 0; elementIndex < this.length; elementIndex++ ){
       this[elementIndex][type].apply(  this[elementIndex], arguments );
    }
  }
} )
