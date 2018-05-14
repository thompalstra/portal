<div class="list-title">
  <i class="material-icons pull-right unload" data-unload data-target=".column.settings-view">arrow_back</i>
  <h4><?=\Core::t( "app", "Settings" )?></h4>
</div>
<form class="form">
  <label>
    <div class="input-row">
      <label class="no-select">
        Enable developer mode
        <input name="[api]developer" type="checkbox" class="default pull-right"  value="" <?=$isDeveloper ? "checked" : ""?>></input>
      </label>
    </div>
  </label>
  <div class="api-token-container <?=$isDeveloper ? "" : "hidden"?>">
    <div class="input-row">
      <label class="no-select">
        API token <button id='generate-api-token' class="button button-raised action">Generate</button>
      </label>
      <input name="[api]token" type="text" class="default" value="<?=\Core::$app->session["user"]["token"]?>"></input>
    </div>
  </div>

  <hr class='default'/>

</form>

<script>
  doc.findOne( '#generate-api-token' ).on( "click", function( event ) {
    event.preventDefault();
    // console.log('generate');
    // app.get( {
    //   responseType: "json",
    //   url: "/components/ajax-generate-api-token",
    //   onsuccess: function( response, xhr, event ){
		//     if( response.success == true ){
    //       doc.findOne( '[name="[api]token"]' ).value = response.data.token;
    //     }
    //   }
    // } );
    app.get( "/components/ajax-generate-api-token", {} )
    .then( response => response.json() )
    .then( function( response ) {
      if( response.success == true ){
        doc.findOne( '[name="[api]token"]' ).value = response.data.token;
      }
    } );
  } );
  doc.findOne( '[name="[api]developer"]' ).on( "change", function( event ) {
    event.preventDefault();
    var developer = this.checked ? 1 : 0;
    // app.get( {
    //   responseType: "json",
    //   url: "/components/ajax-update-developer-mode",
    //   data: {
    //     "developer": developer
    //   },
    //   onsuccess: function( response, xhr, event ){
		//     if( response.success == true ){
    //       if( developer == true ){
    //         doc.findOne( ".api-token-container" ).classList.remove( "hidden" );
    //       } else {
    //         doc.findOne( ".api-token-container" ).classList.add( "hidden" );
    //       }
    //     }
    //   }
    // } );
    app.get( "/components/ajax-update-developer-mode?developer="+developer, {} )
    .then( response => response.json() )
    .then( function( response ) {
      if( response.success == true ){
        if( developer == true ){
          doc.findOne( ".api-token-container" ).classList.remove( "hidden" );
        } else {
          doc.findOne( ".api-token-container" ).classList.add( "hidden" );
        }
      }
    } );
  } );
</script>
