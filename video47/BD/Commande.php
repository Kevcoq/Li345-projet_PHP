<?php 
include 'Outils.inc';
$tmp =0;

$id = DB_connect();


 
if(isset($_POST["NOM"])) {
  $nom = $_POST["NOM"];
  $pass = $_POST["PASS"];

  if($nom != "" && $pass != "") {
    $rep = DB_execSQL("select * from ABONNES a where a.Code='$pass' and a.Nom='$nom'", $id);
    $abo = mysql_fetch_object($rep);

    if($abo != null) { 
      $tmp =2;
      setcookie('identite[nom]', $nom);
      setcookie('identite[code]', $pass);
    }
    else {
      $tmp= 1;
      setcookie('identite[nom]');
      setcookie('identite[code]');
    }
  }
}
 
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Retour</title>
  </head>
  <body>
  <?php 
  echo banniere("Commande.php", "Coquart &amp; Bunel"); 

if($tmp==1)
  echo "<p>Vous n'etes pas inscrit dans la base.</p>";
else
  if($tmp==2 || (isset($_COOKIE['identite']) && $_COOKIE['identite']['nom']!="")) {
    if($tmp != 2) {
      $nom = $_COOKIE['identite']['nom'];
      $pass = $_COOKIE['identite']['code'];
    }

    $rep = DB_execSQL("select * from ABONNES where Code=\"$pass\" and Nom=\"$nom\"", $id);

    if(mysql_fetch_object($rep)) {
      $rep = DB_execSQL("select NbCassettes from ABONNES where Code=\"$pass\" and Nom=\"$nom\"", $id);
      $nb_cas = 3 - mysql_fetch_object($rep)->NbCassettes;
	  
      echo "<p>Vous pouvez emprunter encore $nb_cas cassettes.</p>";

      if($nb_cas > 0) {
	echo '<form method="POST" action="ConfirmeCommande.php">';
	echo '<input type="hidden" name="NB_CASSETTES" value="'.$nb_cas.'"/>';
	echo '<input type="hidden" name="NOM" value="'.$nom.'"/>';
	echo '<input type="hidden" name="PASS" value="'.$pass.'"/>';
		
	echo '<table><tr><th>N°Film</th><th>Support</th></tr>';
	for($var = 1;$var <= $nb_cas; $var++) {
	  echo '<tr><td><input type="input" placeholder="N°Film" name="NumFilm'.$var.'" /></td>';
	  echo '<td><input type="radio" name="Support'.$var.'" value="DVD" checked />DVD | ';
	  echo '<input type="radio" name="Support'.$var.'" value="VHS" />VHS</td></tr>';
	}
	echo '</table>';
	echo '<input type="submit" value="Commander" />';
	echo '</form>';
      }
    } 
  }
  else
    echo "<p>Parametre(s) non renseigné(s)</p>";


?>
</body>
</html>