<!DOCTYPE html>
<html lang="en">
  <?php render_partial("main/header") ?>
  <?php render_partial("main/themes/current-theme", [ "theme" => get_user()["theme"] ] ) ?>
  <body>
    <main id='main' role='main'>
      <div class='progress-indicator'>
        <div class="progress-value"></div>
      </div>
      <div class='columns'>
        <?php render_partial("main/columns/action") ?>
        <?php render_partial("main/columns/main", [ "view" => $view ]) ?>
      </div>
    </main>
    <?php render_partial("main/footer") ?>
  </body>
</html>
