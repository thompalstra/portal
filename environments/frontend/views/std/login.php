<div class='wrap'>
  <form method="POST">
    <?php if( $user->hasErrors() ) : ?>
      <?php foreach( $user->getErrors() as $attribute ) : ?>
        <?php foreach( $attribute as $k => $message ) : ?>
          <?=$message?>
        <?php endforeach; ?>
      <?php endforeach; ?>
    <?php endif; ?>

    <input type="hidden" name="_csrf" value="<?=\Core::$app->security->getCsrfToken()?>" placeholder="<?=\Core::t( "app", "Username" )?>"/>
    <input type="text" name="User[username]" value="<?=$user->username?>" placeholder="<?=\Core::t( "app", "Username" )?>"/>
    <input type="password" name="User[password]" value="<?=$user->password?>" placeholder="<?=\Core::t( "app", "Password" )?>"/>
    <button type="submit"><?=\Core::t( "app", "Submit" )?></button>
  </form>
</div>
