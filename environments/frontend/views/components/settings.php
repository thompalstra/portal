<div class="columns">
  <div class="column settings">
    <h2 class="list-title"><?=\Core::t( "app", "Settings" )?></h2>
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
  <div class="column settings-view" data-empty-content="Nothing to see here"></div>
</div>
