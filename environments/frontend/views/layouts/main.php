<!DOCTYPE html>
<html lang="en">

  <?php

  // $token = \Core::$app->security->generateToken( 32, "-", 4, [] );

  ?>

  <?php render_partial("main/header") ?>
  <body>
    <main id='main' role='main'>
      <div class='progress-indicator'>
        <div class="progress-value"></div>
      </div>

      <div class='columns'>
        <?php if( has_user() ) : ?>
          <?php
          $theme = get_user()["theme"];
          ?>
          <style>
            body{
              background-color: <?=$theme["background"]?>;
            }
            .columns .column.actions{
              background-color: <?=$theme["sidebar_background"]?>;
            }
            .columns .column.actions .icon{
              background-color: <?=$theme["sidebar_button_background"]?>;
              color: <?=$theme["sidebar_button_foreground"]?>;
            }
            .columns .column.actions .icon:hover{
              background-color: <?=$theme["sidebar_button_active_background"]?>;
              color: <?=$theme["sidebar_button_active_foreground"]?>;
            }
          </style>
          <div class='column actions bg-darker'>
            <?php render_partial("main/columns/action") ?>
          </div>
          <div class="column main cw-md-12">

            <!-- <div class="notification-popup">
              <div class="content">
                <div class="source">
                  <div class="source-logo"><img src="/environments/frontend/assets/img/dnovo-icon.png"/></div>
                  <div class="source-name">Dnovo</div>
                </div>
                <div class="data">
                  <div class="inner">
                    <div class="data-title">What's new?</div>
                    <div class="data-content">Major updates!</div>
                  </div>
                  <div class="icon">
                    <img src="/environments/frontend/assets/img/dnovo-icon.png"/>
                  </div>
                </div>
              </div>
              <div class="options-bar">
                <button class="button button-flat info" data-on="click" data-trigger="close">CLOSE</button>
              </div>
            </div> -->

            <!-- <div class="notification-popup">
              <div class="content">
                <div class="source">
                  <div class="title-img">
                    <img src="/environments/frontend/assets/img/dnovo-icon.png"/>
                  </div>
                  <div class="title-label">test</div>
                </div>
                <div class="data">
                  <div class="inner">
                    <div class="content-title">news</div>
                    <div class="content-description">test</div>
                  </div>
                  <div class="content-img">
                    <img src="/environments/frontend/assets/img/dnovo-icon.png">
                  </div>
                </div>
              </div>
              <div class="options-bar"><button data-trigger="close" class="button button-flat info">close</button>
              </div>
            </div> -->

            <?php render_partial("main/columns/main", [ "view" => $view ]) ?>
          </div>
        <?php else : ?>
          <?=$view?>
        <?php endif; ?>
      </div>
    </main>
    <?php render_partial("main/footer") ?>
  </body>
</html>
