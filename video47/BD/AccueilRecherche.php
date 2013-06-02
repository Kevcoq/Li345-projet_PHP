<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>AccueilRecherche</title>
   </head>
   <body>
   <?php 
   include 'Outils.inc'; 
echo banniere("AccueilRecherche.php", "Coquart &amp; Bunel"); 
?>
<div>
<form method="POST" action="Recherche.php">
  Recherche de films :<br /> mot cléf du titre

  <!-- On suppose que l\'utilisateur doit taper le titre exact ou rien -->
  <input type="text" name="TITRE" /><br />
  <!-- Liste de choix pour le support -->
  <span>Support : <?php
  $sup = array("Indifférent", "DVD", "VHS");
echo "<select name=\"SUPPORT\" size=\"1\">";
foreach($sup as $tmp) {
  echo "<option>$tmp</option>";
}
echo "</select>";
?>
</span>

<!-- Liste de choix pour la dispo -->
<span>Disponibilité : <?php
$dispo = array("Indifférent", "disponible");
echo "<select name=\"DISPO\" size=\"1\">";
foreach($dispo as $tmp) {
  echo "<option>$tmp</option>";
}
echo "</select>";
?>
</span>

<!-- Liste de choix pour le genre -->
<span>Genre : <?php
  // Connexion "poux.ufr-info-p6.jussieu.fr"
$id = mysql_connect("localhost", "video47", "9198");
if ($id == 0) {
  echo "Connexion à poux échouée";
  exit;
}
if (mysql_select_db("video47", $id) == 0) {
  echo "Accès à la base échoué";
  exit;
}

$id_rep = mysql_query("select distinct(f.Genre) from FILMS f", $id);


echo "<select name=\"GENRE\" size=\"1\">";
echo "<option>Indifférent</option>";
if($id_rep != 0)  {
  while ($genre_tmp = mysql_fetch_object($id_rep)) 
    echo "<option>$genre_tmp->Genre</option>";
}	
echo "</select>";
?>
</span>

<!-- Liste de choix pour le realisateur -->
<span>Realisateur : <?php

$id = DB_connect();
$rea = DB_execSQL("select distinct(f.Realisateur) from FILMS f", $id);
 
echo "<select name=\"REALISATEUR\" size=\"1\">";
echo "<option>Indifférent</option>";
while ($rea_tmp = mysql_fetch_object($rea)) {
  echo "<option>$rea_tmp->Realisateur</option>";
}
echo "</select>";
?>
</span>

<!-- Liste de choix pour l\'acteur -->
<span>Acteur : <?php

$id = DB_connect();
$act = DB_execSQL("select distinct(a.Acteur) from ACTEURS a", $id);

echo "<select name=\"ACTEUR\" size=\"1\">";
echo "<option>Indifférent</option>";
while ($act_tmp = mysql_fetch_object($act)) {
  echo "<option>$act_tmp->Acteur</option>";
}
echo "</select>";
?>
</span> <br /> <input type="submit" value="Soumettre" />
  </form>
  </div>
  </body>
  </html>
