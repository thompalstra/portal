document.addEventListener( "DOMContentLoaded", ( event ) => {
  doc.on( "click", "[data-navigate][href]", function( event ) {
      event.preventDefault();
      var target = this;
      if( this.hasAttribute( "data-target" ) ){
        target = doc.findOne( this.getAttribute('data-target') );
      }
      var url = this.getAttribute( "href" );

      target.load( url, function( event ) {
      } );
  } );

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
  this.content.innerHTML =
    "<div class='source'>\
        <div class='title-img'><img src='" + options.title.img + "'></div>\
        <div class='title-label'>" + options.title.label + "</div>\
      </div>\
      <div class='data'>\
        <div class='inner'>\
          <div class='content-title'>" + options.content.title + "</div>\
          <div class='content-description'>"  + options.content.description +  "</div>\
        </div>\
        <div class='content-img'>\
          <img src='" + options.content.img + "'>\
        </div>\
      </div>";


    if( options.hasOwnProperty( "buttons" ) && Object.keys(options.buttons).length > 0 ){
      this.optionsBar = this.element.appendChild( document.createElement( "div" ) );
      this.optionsBar.className = "options-bar";

      for( var buttonIndex in options.buttons ){
        var btn = this.optionsBar.appendChild( document.createElement( "button" ) );
        btn.className = "button button-flat info";
        btn.setAttribute( "data-trigger", buttonIndex );

        btn.on( "click", function ( event ) {
          this.widget.element.do( this.element.dataset.trigger );
        }.bind( {
          widget: this,
          element: btn
        } ) )

        btn.innerHTML = buttonIndex;

        var opt = options.buttons[buttonIndex];
        if( typeof opt == "object" && Object.keys(opt).length > 0 ){
          for( var optIndex in opt ){
            btn.setAttribute( optIndex, opt[optIndex] ) ;
          }
        }
      }
    }

    this.element.on( "close", ( event ) => { this.close(); } )
    this.element.timeout = setTimeout( ( event ) => { this.close(); }, 5000 );
}
NotificationPopUp.prototype.show = function(){

}
NotificationPopUp.prototype.close = function(){
  if( this.dismissing !== true ){
    this.dismissing = true;
    if( this.element.timeout ){
      clearTimeout( this.element.timeout );
    }
    this.element.classList.add( "dismissing" );
    setTimeout( ( event ) => {
      this.element.remove();
    }, 1000 );
  }
}
