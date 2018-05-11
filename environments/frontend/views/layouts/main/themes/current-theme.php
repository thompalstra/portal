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
  .columns .column.actions .icon:active:hover{
    background-color: <?=$theme["sidebar_button_active_background"]?>;
    color: <?=$theme["sidebar_button_active_foreground"]?>;
  }
  .list .items .active .item{
    border-left-color: <?=$theme["sidebar_button_active_background"]?>;

  }

  .columns .column.actions .icon:active:hover,
  .columns .column.actions .icon.active,
  .notifications-index .list .items .item.unread:after,
  .columns .column.actions .unread{
    background-color: <?=$theme["sidebar_button_active_background"]?>;
  }
</style>
