<div class='login-wrapper'>
  <form method="POST">
    <input type="hidden" name="_csrf" value="<?=\Core::$app->security->getCsrfToken()?>" placeholder="<?=\Core::t( "app", "Username" )?>"/>
      <input type="text" class="default" name="User[username]" value="<?=$user->username?>" placeholder="<?=\Core::t( "app", "Username" )?>"/>
      <?php if( $user->hasErrors( "username" ) ) : ?>
        <label class="label label-default warning"><?=$user->getFirstError( "username" )?></label>
      <?php endif; ?>
      <input type="password" class="default" name="User[password]" value="<?=$user->password?>" placeholder="<?=\Core::t( "app", "Password" )?>"/>
      <?php if( $user->hasErrors( "password" ) ) : ?>
        <label class="label label-default warning"><?=$user->getFirstError( "password" )?></label>
      <?php endif; ?>
    <div class="row mv-1">
      <button type="submit" class="button button-raised action"><?=\Core::t( "app", "Submit" )?></button>
    </div>
  </form>
</div>
