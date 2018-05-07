<nav id='nav' class='nav nav-default bg-action fg-white'>
  <ul class='items'>
    <li class='item icon dropdown top right togglable' data-target="#sidebar">
      <span class="reactive-dark">
        <i class="material-icons">menu</i>
      </span>
    </li>
    <li class="item">
      <span class="reactive-dark">
        <span>
          <?=\Core::$app->params['title']?>
        </span>
      </span>
    </li>
    <li class='item icon dropdown top right togglable'>
      <span class="reactive-dark">
        <i class="material-icons">more_vert</i>
        <ul class="items">
          <li class="item">
            <a href="/settings/profile" class="reactive-dark">
              <?=\Core::t( 'app', 'Profile' )?>
            </a>
          </li>
          <li class="item">
            <a href="/settings/profile" class="reactive-dark">
              <?=\Core::t( 'app', 'Notifications' )?>
            </a>
          </li>
          <li class="item">
            <a href="/settings/profile" class="reactive-dark">
              <?=\Core::t( 'app', 'Advanced' )?>
            </a>
          </li>
        </ul>
      </span>
    </li>
  </ul>
</nav>
<div id='sidebar' class='sidebar sidebar-default top left bottom bg-action fg-white togglable'>
  <ul class='items'>
    <li class='item'>
      <a href="/jobs" class="reactive-dark" title="Bekijk jobs">
        <i class="material-icons sidebar-jobs" data-unread="5">work</i> <label class="label"><?=\Core::t( 'app', 'Jobs' )?></label>
      </a>
    </li>
    <li class='item'>
      <a href="/sites" class="reactive-dark" title="Bekijk sites">
        <i class="material-icons sidebar-sites" data-unread="5">web</i> <label class="label"><?=\Core::t( 'app', 'Sites' )?></label>
      </a>
    </li>
    <li class='item'>
      <a href="/notifications" class="reactive-dark" title="Bekijk meldingen">
        <i class="material-icons sidebar-notifications" data-unread="5">notifications</i> <label class="label"><?=\Core::t( 'app', 'Notifications' )?></label>
      </a>
    </li>
    <li class='item'>
      <a href="/settings" class="reactive-dark">
        <i class="material-icons sidebar-settings">settings</i> <label class="label"><?=\Core::t( 'app', 'Settings' )?></label>
      </a>
    </li>
  </ul>
</div>
<div class='backdrop'></div>
