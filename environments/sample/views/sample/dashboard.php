<pre>
<h1><?=$title?></h1>
<?=$message?>
</pre>

<?php
$options = [
  "Default routes - via /config/routes.php" => [
    "/" => "Dashboard",
    "/this-does-not-match" => "This does not match",
  ],
  "Default routes with variables - via /config/routes.php" => [
    "/notifications/99" => "Notifications view",
    "/notifications/AD" => "Notifications view invalid value",
    "/sites/my-valid-site_com" => "Sites view",
    "/sites/my-invalid-site-com" => "Sites view invalid value",
    "/sites/list/25" => "Sites list, page 25",
    "/sites/list/2/33" => "Sites list, page 2, per page 33",
  ],
  "Runs routes via other means" => [
    "/my-route-component" => "Runs route via a class of \core\web\RouteComponent",
    "/logout" => "Runs route via an installed plugin",
  ]
];

?>
<select id='select'>
<?php foreach( $options as $groupName => $group ) : ?>
    <optgroup label="<?=$groupName?>">
  <?php foreach( $group as $value => $label ) : ?>
    <option value="<?=$value?>" <?=( \Core::$app->url == $value ? "selected" : "")?> ><?=$label?></option>
  <?php endforeach; ?>
    </optgroup>
<?php endforeach; ?>
</select>
<script>
document.getElementById('select').addEventListener('input', function(event) {
  location.href = this.options[ this.selectedIndex ].value;
} );
</script>

<!-- <select id='select'>
  <optgroup label="Default routes - via /config/routes.php">
    <option data-url="/">Dashboard</option>
    <option data-url="/this-does-not-match">This does not match</option>
  </optgroup>
  <optgroup label="Default routes with variables - via /config/routes.php">
    <option data-url="/notifications/99">Notifications view</option>
    <option data-url="/notifications/AD">Notifications view invalid value</option>
    <option data-url="/sites/my-valid-site_com">Sites view</option>
    <option data-url="/sites/my-invalid-site-com">Sites view invalid value</option>
    <option data-url="/sites/list/25">Sites list, page 25</option>
    <option data-url="/sites/list/2/33">Sites list, page 2, per page 33</option>
  </optgroup>
  <optgroup label="Runs routes via other means">
    <option data-url="/my-route-component">Runs route via a class of \core\web\RouteComponent</option>
    <option data-url="/logout">Runs route via an installed plugin</option>
  </optgroup>
</select>
<script>
  document.getElementById('select').addEventListener('input', function(event) {
    location.href = this.options[ this.selectedIndex ].dataset.url
  } );
</script> -->
