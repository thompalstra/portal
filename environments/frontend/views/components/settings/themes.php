<div class="list-title">
  <i class="material-icons pull-right unload" data-unload data-target=".column.settings-view">arrow_back</i>
  <h4><?=\Core::t( "app", "Settings" )?></h4>
</div>
<form id="theme-settings-form" method="POST">
  <div class="p-1">
    <button class="button button-raised action"><?=\Core::t( "app", "Submit" )?></button>
    <button id="theme-settings-form-reset" class="button button-flat"><?=\Core::t( "app", "Reset" )?></button>
  </div>
  <div class="list themes">
    <div class="items"><label>
      <div class="item">
        <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Background" )?>
        <input type="color"
          name="Theme[params][background]"
          class="default mh-1"
          value="<?=$theme->params["background"]?>"
          style="color:<?=$theme->params["background"]?>"/>
      </div>
    </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar background" )?>
          <input type="color"
            name="Theme[params][sidebar_background]"
            class="default mh-1"
            value="<?=$theme->params["sidebar_background"]?>"
            style="color:<?=$theme->params["sidebar_background"]?>"/>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button background" )?>
          <input type="color"
            name="Theme[params][sidebar_button_background]"
            class="default mh-1"
            value="<?=$theme->params["sidebar_button_background"]?>"
            style="color:<?=$theme->params["sidebar_button_background"]?>"/>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button foreground" )?>
          <input type="color"
            name="Theme[params][sidebar_button_foreground]"
            class="default mh-1"
            value="<?=$theme->params["sidebar_button_foreground"]?>"
            style="color:<?=$theme->params["sidebar_button_foreground"]?>"/>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button (active) background" )?>
          <input type="color"
            name="Theme[params][sidebar_button_active_background]"
            class="default mh-1"
            value="<?=$theme->params["sidebar_button_active_background"]?>"
            style="color:<?=$theme->params["sidebar_button_active_background"]?>"/>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button (active) foreground" )?>
          <input type="color"
            name="Theme[params][sidebar_button_active_foreground]"
            class="default mh-1"
            value="<?=$theme->params["sidebar_button_active_foreground"]?>"
            style="color:<?=$theme->params["sidebar_button_active_foreground"]?>"/>
        </div>
      </label>
    </div>
  </div>
</form>

<script>
  doc.on( "change", 'input[type="color"].default', function( event ) {
    this.style["color"] = this.value;
  } );
  doc.findOne( "#theme-settings-form-reset" ).on( "click", function( event ) {
    event.preventDefault();
    var c = confirm( "<?=\Core::t( "app", "Are you sure you want to reset your theme to the default values?" )?>" );

    if( c ){
      app.post( {
        url: "/components/settings/themes",
        responseType: "json",
        data: {
          "reset": "1"
        },
        onsuccess: function( response, xhr, event ){
          if( response.success == true ){
            new NotificationPopUp( doc.findOne( ".column.settings-view"  ), response.data.notification );
          }
        }
      } );
    }
  } );
  doc.findOne( "#theme-settings-form" ).on( "submit", function( event ) {
    event.preventDefault();
    app.post(  "/components/settings/themes", {
      body: new FormData( this ),
    } )
    .then( response => response.json() )
    .then( function( response ) {
      if( response.success == true ) {
         new NotificationPopUp( doc.findOne( ".column.settings-view"  ), response.data.notification );
      }
    } )
  } )
</script>
