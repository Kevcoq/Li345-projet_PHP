<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Description d\'un film</title>
   </head>
   <body>	
   <?php 
   include 'Outils.inc'; 
echo banniere("Descriptif.php", "Coquart &amp; Bunel"); 
?>


<?php
$n = $_POST["N_FILM"];
if (isSet($n)) {
  $id = DB_connect();
  $rep = DB_execSQL("select * from FILMS f where f.NoFilm='$n'", $id);

  $film = mysql_fetch_object($rep);     //il n'y en a qu'un
  if($film != null) {
    echo "<table>";
    echo "<tr><td>Numéro : </td><td>" . $film->NoFilm . "</td></tr>";
    echo "<tr><td>Titre : </td><td>" . $film->Titre . "</td></tr>";
    echo "<tr><td>Nationalité : </td><td>" . $film->Nationalite . "</td></tr>";
    echo "<tr><td>Réalisateur : </td><td>" . $film->Realisateur . "</td></tr>";
    echo "<tr><td>Année : </td><td>" . $film->Annee . "</td>";
    echo "<td>" . $film->Couleur . "</td>";
    echo "<td>Durée : </td><td>" . $film->Duree . "</td></tr>";
    echo "<tr><td>Résumé : </td><td colspan=4>" . $film->Synopsis . "</td></tr>";
    echo "<tr><td>Genre : </td><td>" . $film->Genre . "</td></tr>";

    $rep2 = DB_execSQL("select a.Acteur from ACTEURS a , FILMS f where f.NoFilm='$n' and a.NoFilm = f.NoFilm", $id);

    echo "<tr><td>Acteurs</td><td><ul>";
    while ($act = mysql_fetch_object($rep2)) {
      echo "<li>$act->Acteur</li>";
    }
    
    echo "</ul></td></tr></table>";
    echo '<form method="POST" action="AjoutSelection.php" target="Panier">';
    echo '<input type="hidden" name="NoFilm" value="$film->NoFilm" />';
    echo '<input type="submit" value="AjoutSelection"/>';
    echo '</form><form method="POST" action="VoirSelection.php" target="Panier" >';
    echo '<input type="submit" value="VoirSelection"/></form>';

  }
  else
    echo "<p>Votre recherche ne donne rien.</p>";
}
?>


</body>
</html>
