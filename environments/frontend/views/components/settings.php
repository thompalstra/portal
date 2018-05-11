<div class="columns">
  <div class="column settings">
    <div class="list-title">
      <h4><?=\Core::t( "app", "Settings" )?></h4>
    </div>
    <div class='list'>
      <div class='items'>
        <a data-navigate data-target=".column.settings-view" href="/components/settings/themes">
          <div class='item'>
            <span class="icon"><i class="material-icons">color_lens</i></span> <?=\Core::t( "app", "Themes" )?>
          </div>
        </a>
        <a data-navigate data-target=".column.settings-view" href="/components/settings/developers">
          <div class='item'>
            <span class="icon"><i class="material-icons">code</i></span> <?=\Core::t( "app", "Developer" )?>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="column settings-view" data-empty-content="<?=Core::t( "app", "Nothing to display" )?>"></div>
</div>
