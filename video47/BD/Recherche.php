<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Recherche</title>
   </head>
   <body>
   <?php 
   include 'Outils.inc'; 
echo banniere("Recherche.php", "Coquart &amp; Bunel"); 

$titre = $_POST["TITRE"];
$support = $_POST["SUPPORT"];
$dispo = $_POST["DISPO"];
$genre = $_POST["GENRE"];
$realisateur = $_POST["REALISATEUR"];
$acteur = $_POST["ACTEUR"];

$bool = false;

$requete = "select distinct(f.Titre), f.Realisateur, f.Annee, f.NoFilm from FILMS f , CASSETTES c , ACTEURS a";
if ($titre != "")  {  
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Titre = '$titre'"; 
}
if ($genre!= "Indifférent") {  
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Genre = '$genre' "; 
}
if ($realisateur!= "Indifférent") {
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Realisateur = '$realisateur' "; 
}

if ($support != "Indifférent") { 
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = c.NoFilm and c.Support = '$support' "; 
}
if ($dispo != "Indifférent") {
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = c.NoFilm and c.Statut = '$dispo' "; 
}

if ($acteur != "Indifférent") {
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = a.NoFilm and a.Acteur = '$acteur' ";
} 

$id = DB_connect();
$rep = DB_execSQL($requete, $id);

echo '<h1>Résultats de la recherche</h1><ul>';
while ($tmp = mysql_fetch_object($rep)) {
  echo "<li>$tmp->Titre, $tmp->Realisateur, $tmp->Annee, ";
  echo '<form method="POST" action="AjoutSelection.php" target="Panier">';
  echo '<input type="hidden" name="NoFilm" value="'.$tmp->NoFilm.'" />';
  echo '<input type="submit" value="AjoutSelection"/></form></li>';
}
echo "</ul>";
echo '<form method="POST" action="VoirSelection.php" target="Panier">';
echo '<input type="submit" name="VoirSelection"/></form>';

?>
</body>
</html>
