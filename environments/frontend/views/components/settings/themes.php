<form id="theme-settings-form" method="POST">
  <div class="p-1">
    <button class="button button-raised action"><?=\Core::t( "app", "Submit" )?></button>
    <button id="theme-settings-form-reset" class="button button-flat"><?=\Core::t( "app", "Reset" )?></button>
  </div>
  <div class="list themes">
    <div class="items"><label>
      <div class="item">
        <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Background" )?>
        <input type="color" name="[Theme][params]background" class="mh-1" value=<?=$theme->params["background"]?>></input>
      </div>
    </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar background" )?>
          <input type="color" name="[Theme][params]sidebar_background" class="mh-1" value=<?=$theme->params["sidebar_background"]?>></input>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button background" )?>
          <input type="color" name="[Theme][params]sidebar_button_background" class="mh-1" value=<?=$theme->params["sidebar_button_background"]?>></input>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button foreground" )?>
          <input type="color" name="[Theme][params]sidebar_button_foreground" class="mh-1" value=<?=$theme->params["sidebar_button_foreground"]?>></input>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button (active) background" )?>
          <input type="color" name="[Theme][params]sidebar_button_active_background" class="mh-1" value=<?=$theme->params["sidebar_button_active_background"]?>></input>
        </div>
      </label>
      <label>
        <div class="item">
          <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Sidebar button (active) foreground" )?>
          <input type="color" name="[Theme][params]sidebar_button_active_foreground" class="mh-1" value=<?=$theme->params["sidebar_button_active_foreground"]?>></input>
        </div>
      </label>
    </div>
  </div>
</form>

<script>
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
    app.post( {
      url: "/components/settings/themes",
      responseType: "json",
      data: {
        Theme: {
          params: {
            "background": doc.findOne( '[name="[Theme][params]background"]' ).value,
            "sidebar_background": doc.findOne( '[name="[Theme][params]sidebar_background"]' ).value,
            "sidebar_button_background": doc.findOne( '[name="[Theme][params]sidebar_button_background"]' ).value,
            "sidebar_button_foreground": doc.findOne( '[name="[Theme][params]sidebar_button_foreground"]' ).value,
            "sidebar_button_active_background": doc.findOne( '[name="[Theme][params]sidebar_button_active_background"]' ).value,
            "sidebar_button_active_foreground": doc.findOne( '[name="[Theme][params]sidebar_button_active_foreground"]' ).value
          }
        }
      },
      onsuccess: function( response, xhr, event ){
        if( response.success == true ){
          new NotificationPopUp( doc.findOne( ".column.settings-view"  ), response.data.notification );
        }
      }
    } );
  } )
</script>
