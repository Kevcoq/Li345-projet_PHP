<?php 
include 'Outils.inc';

$tmp ="";

  
if(isset($_COOKIE['selection']) && $_COOKIE['selection'][0] > 0) {
  setcookie('selection[0]', 0);
  $tmp = "Panier vidé.";
}
else 
  $tmp = "Aucun film ajouté";

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Panier</title>
  </head>
  <body>
  <hr />
  <?php
  echo $tmp;
?>
</body>
</html>

