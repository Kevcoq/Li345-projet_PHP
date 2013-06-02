<?php 
include 'Outils.inc';

$tmp ="";

  
if(isset($_COOKIE['selection']) && $_COOKIE['selection'][0] > 0) {
  $nb = $_COOKIE['selection'][0];
  $ind=1;
  for($var = 1; $var <= $nb; $var++)
    if(!isset($_POST["Case".$var])) {
      $n_film = $_COOKIE['selection'][$var];
      setcookie("selection[".$ind."]", $n_film);
      $ind++;
    }
  setcookie('selection[0]', $ind-1);
  $tmp = "Il y a ".($ind-1)." film(s) supprimé(s).";
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

