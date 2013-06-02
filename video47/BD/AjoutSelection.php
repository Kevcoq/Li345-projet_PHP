<?php 
include 'Outils.inc';

 
$n_film = $_POST["NoFilm"];
  
if(isset($_COOKIE['selection'])) {
  $nb = $_COOKIE['selection'][0] +1;
  setcookie('selection[0]', $nb);
  setcookie("selection[$nb]", $n_film);
}
else {
  setcookie('selection[0]',1);
  setcookie('selection[1]',$n_film);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Panier</title>
  </head>
  <body>
  <hr />
  <p>Film ajouté</p>
  </body>
  </html>

