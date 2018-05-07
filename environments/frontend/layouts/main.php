<!DOCTYPE html>
<html lang="en">
  <?= render_partial( "partials/main/header" ) ?>
  <body>
    <main id='main' role='main'>
      <?= render_partial( "partials/main/navigation" ) ?>
      <?= $view ?>
    </main>
    <?= render_partial( "partials/main/footer" ) ?>
  </body>
</html>
