<div class='wrap'>
  <form>
    <input type="hidden" name="_csrf" placeholder="<?=\Core::t( "app", "Username" )?>"/>
    <input type="text" name="LoginForm[username]" placeholder="<?=\Core::t( "app", "Username" )?>"/>
    <input type="password" name="LoginForm[password]" placeholder="<?=\Core::t( "app", "Password" )?>"/>
    <button type="submit"><?=\Core::t( "app", "Submit" )?></button>
  </form>
</div>
