document.addEventListener( "DOMContentLoaded", function ( event ) {
  doc.on( "click", "[data-navigate][href]", function( event ) {
      event.preventDefault();
      var target = this;
      if( this.hasAttribute( "data-target" ) ){
        target = doc.findOne( this.getAttribute('data-target') );
      }
      var url = this.getAttribute( "href" );
      
      target.load( url ).then( function ( response ) { } );
  } );

  doc.on( "click", ".columns .column.actions [data-navigate]", function( event ) {
    var ctx = this;
    this.closest(".column").findAll( "[data-navigate]" ).forEach( function( node ) {
      if( node == ctx ){
        node.classList.add( "active" );
      } else {
        node.classList.remove( "active" );
      }
    } );
  } );

  doc.on( "click", ".list .items [data-navigate]", function( event ) {
    var ctx = this;
    this.closest(".items").findAll( "[data-navigate]" ).forEach( function( node ) {
      if( node == ctx ){
        node.classList.add( "active" );
      } else {
        node.classList.remove( "active" );
      }
    } );
  } )

  doc.on( "click", "[data-navigate-to][href]", function( event ) {
    location.href = this.getAttribute( "href" );
  } )

  doc.on( "ajax.progress.update", function( event ) {
    progressElement = doc.findOne('.progress-indicator .progress-value');
    progressElement.style['width'] = event.progress + "%";
    if( event.progress == 100 ){
      progressElement.style['transition'] = 'none';
      progressElement.style['width'] = '0%';
      progressElement.style['transition'] = '';
    }
  } );

  doc.on( "click", "[data-unload]", function( event ) {
    var target = doc.findOne( this.getAttribute( "data-target" ) );
    target.innerHTML = "";
  } );
} );



var NotificationPopUp = function( parentElement, options ){
  this.parentElement = parentElement;
  this.element;

  this.content;
  this.optionsBar;

  this.create( options );
}

NotificationPopUp.prototype.create = function( options ){
  this.element = this.parentElement.appendChild( document.createElement( "div" ) );
  this.element.className = "notification-popup";

  this.content = this.element.appendChild( document.createElement( "div" ) );
  this.content.className = "content";

  if( options.hasOwnProperty( "options" ) && options.options.hasOwnProperty( "dismiss" ) && options.options.dismiss == true ){
    this.btnDismiss = this.content.appendChild( document.createElement( "i" ) );
    this.btnDismiss.className = "material-icons dismiss";
    this.btnDismiss.innerHTML = "close";

    this.btnDismiss.addEventListener( "click", ( event ) => {
      this.close();
    } );
  }

  this.contentSource = this.content.appendChild( document.createElement( "div" ) );
  this.contentSource.className = "source";
  this.contentSource.innerHTML =
    "<div class='title-img'><img src='" + options.title.img + "'></div>\
    <div class='title-label'>" + options.title.label + "</div>";

  this.contentData = this.content.appendChild( document.createElement( "div" ) );
  this.contentData.className = "data";
  this.contentData.innerHTML =
    "<div class='content'>\
      <div class='title'>" + options.content.title + "</div>\
      <div class='description'>"  + options.content.description +  "</div>\
    </div>\
    <div class='content-img'>\
      <img src='" + options.content.img + "'>\
    </div>";

  if( options.hasOwnProperty( "buttons" ) && Object.keys(options.buttons).length > 0 ){
    this.optionsBar = this.element.appendChild( document.createElement( "div" ) );
    this.optionsBar.className = "button-bar";

    for( var buttonIndex in options.buttons ){
      var btn = this.optionsBar.appendChild( document.createElement( "button" ) );
      btn.className = "button button-flat info";
      btn.setAttribute( "data-trigger", buttonIndex );

      btn.on( "click", function ( event ) {
        this.widget.element.do( this.element.dataset.trigger );
      }.bind( {
        widget: this,
        element: btn
      } ) );

      btn.innerHTML = buttonIndex;

      var opt = options.buttons[buttonIndex];
      if( typeof opt == "object" && Object.keys(opt).length > 0 ){
        for( var optIndex in opt ){
          btn.setAttribute( optIndex, opt[optIndex] ) ;
        }
      }
    }
  }

  this.element.removeTimeout = null;
  this.element.timeout = setTimeout( ( event ) => { this.close(); }, 5000 );

  this.registerEventListeners();
}
NotificationPopUp.prototype.registerEventListeners = function(){
    this.element.addEventListener( "close", ( event ) => {
      this.close();
  } );

  this.element.addEventListener( "mouseenter", ( event ) => {
    if( this.element.timeout != null ){
      clearTimeout( this.element.timeout );
      this.element.timeout = null;
    }
    if( this.element.removeTimeout != null ){
      clearTimeout( this.element.removeTimeout );
      this.element.classList.remove( "dismissing" );
      this.element.removeTimeout = null;
    }
  } );

  this.element.addEventListener( "mouseleave", ( event ) => {
    if( this.element.timeout == null ){
      this.element.timeout = setTimeout( ( event ) => { this.close(); }, 5000 );
    }
  } );
}
NotificationPopUp.prototype.show = function(){

}
NotificationPopUp.prototype.close = function(){
  if( this.element.removeTimeout == null ){
    this.element.classList.add( "dismissing" );
    this.element.removeTimeout = setTimeout( ( event ) => {
      this.element.remove();
    }, 1000 );
  }
}
