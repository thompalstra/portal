<!DOCTYPE html>
<html lang="en">
  <?php render_partial("main/header") ?>
  <body>
    <main id='main' role='main'>
      <div class='progress-indicator'>
        <div class="progress-value"></div>
      </div>

      <div class='columns'>
        <?php if( has_user() ) : ?>
          <div class='column actions bg-darker'>
            <?php render_partial("main/columns/action") ?>
          </div>
          <div class="column main cw-md-12">
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
