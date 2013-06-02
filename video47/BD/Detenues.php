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
  <title>Description d'un film</title>
  </head>
  <body>	
  <?php 
  echo banniere("Detenues.php", "Coquart &amp; Bunel"); 

if($tmp==1)
  echo "<p>Identifiction incorrecte</p>";
else
  if($tmp==2 || (isset($_COOKIE['identite']) && $_COOKIE['identite']['nom']!="")) {
    if($tmp != 2) {
      $nom = $_COOKIE['identite']['nom'];
      $pass = $_COOKIE['identite']['code'];
    }
    $rep = DB_execSQL("select * from ABONNES a where a.Code='$pass' and a.Nom='$nom'", $id);
    $abo = mysql_fetch_object($rep);
    
    
    if($abo->NbCassettes == 0)
      echo "<p>Vous ne possedez aucune cassettes</p>";
    else {
      $requete = "select c.NoFilm, c.NoExemplaire, f.Titre, f.Realisateur, e.DateEmpRes from FILMS f, CASSETTES c, EMPRES e where e.CodeAbonne='$abo->Code' and f.NoFilm=c.NoFilm and c.NoFilm=e.NoFilm and c.NoExemplaire=e.NoExemplaire";
      //echo $requete;
      $rep = DB_execSQL($requete, $id);
      
      while($tmp = mysql_fetch_object($rep)) {
	$date = $tmp->DateEmpRes;
	echo "<ul><li><i>Film n° : </i>$tmp->NoFilm | <i>Exemplaire n° : </i>$tmp->NoExemplaire</li><li><i>Titre : </i>$tmp->Titre</li><li><i>Realisateur : </i>$tmp->Realisateur</li><li><i>Date d'emprunt : </i>$date</li></ul>";
      }
    }
  } 
  else
    echo "<p>Parametre(s) non renseigné(s)</p>";
?>

</body>
</html>
