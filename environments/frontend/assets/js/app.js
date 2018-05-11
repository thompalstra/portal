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
    response: {
      body: {},
      headers: {},
      cache: "no-cache",
      credentials: "same-origin",
      method: "GET",
      mode: "cors",
      redirect: "follow",
      referrer: "no-referrer"
    }
  },
  serialize: function(obj, prefix) {
    var str = [],
      p;
    for (p in obj) {
      if (obj.hasOwnProperty(p)) {
        var k = prefix ? prefix + "[" + p + "]" : p,
          v = obj[p];
        str.push((v !== null && typeof v === "object") ?
          app.serialize(v, k) :
          encodeURIComponent(k) + "=" + encodeURIComponent(v));
      }
    }
    return str.join("&");
  },
  responseOptions: function( options ){
    if( !options.hasOwnProperty( "body" ) ){
      options.body = JSON.stringify({});
    } else {
      if( options.body instanceof FormData ){
        var object = {};
        options.body.forEach(function(value, key){
            object[key] = value;
        });
        options.body = object;
      }
      options.body = app.serialize( options.body );
    }
    if( !options.hasOwnProperty( "headers" ) ){
      options.headers = app.defaults.response.headers;
    }
    if( !options.hasOwnProperty( "cache" ) ){
      options.cache = app.defaults.response.cache;
    }
    if( !options.hasOwnProperty( "credentials" ) ){
      options.credentials = app.defaults.response.credentials;
    }
    if( !options.hasOwnProperty( "method" ) ){
      options.method = app.defaults.response.method;
    }
    if( !options.hasOwnProperty( "mode" ) ){
      options.mode = app.defaults.response.mode;
    }
    if( !options.hasOwnProperty( "redirect" ) ){
      options.redirect = app.defaults.response.redirect;
    }
    if( !options.hasOwnProperty( "referrer" ) ){
      options.referrer = app.defaults.response.referrer;
    }
    return options
  },
  post: function( url, responseOptions ){
    var opt = app.responseOptions( responseOptions );
    opt.method = "POST";
    opt.headers[ "content-type" ] = 'application/x-www-form-urlencoded';
    return fetch( url, opt );
  }
}, true )

extend( Document, HTMLElement ).with( {
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
    eventTypes.split(" ").forEach(  ( eventType ) => {
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
    document.do( "ajax.progress.update", { progress: "15" } );

    var filterTarget;

    if( url.indexOf( " " ) > -1 ){
      filterTarget = url.substring( url.indexOf( " " ) + 1, url.length );
      url = url.substring( 0, url.indexOf( " " ) );
    }

    var headers = new Headers();
    headers.append("x-requested-with", "xmlhttprequest");

    return fetch( url, {
      method: "GET",
      mode: "no-cors",
      cache: 'no-cache',
      credentials: 'same-origin',
      headers: headers
    } )
    .then( response => response.text() )
    .then( response => ( new DOMParser() ).parseFromString( response , "text/html") )
    .then( function( response ) {
      var target = this.element;
      if( this.filterTarget ){
        target.innerHTML = response.findOne( this.filterTarget ).innerHTML;
      } else {
        target.innerHTML = response.head.innerHTML + response.body.innerHTML;
      }
      target.findAll( 'script' ).forEach( ( originalScriptElement ) => {
        var newScriptElement = target.appendChild(  document.createElement( 'script' ) );
        newScriptElement.innerHTML = originalScriptElement.innerHTML;
        originalScriptElement.remove();
      } );

      return response;
    }.bind( {
      element: this,
      filterTarget: filterTarget
    } ) );
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
