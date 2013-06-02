<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Retour</title>
   </head>
   <body>
   <?php 
   include '../BD/Outils.inc'; 
?>
	
<?php
$n_film = $_POST["N_FILM"];
$n_exemp = $_POST["N_EXEMPL"];

$id = DB_connect();

// Test dans EMPRES
$rep = DB_execSQL("select * from EMPRES where NoFilm=$n_film and NoExemplaire=$n_exemp", $id);
if(mysql_fetch_object($rep)) {
  // MAJ cassettes 
  $rep = DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=$n_film and NoExemplaire=$n_exemp", $id);

  // MAJ abonnes
  $rep = DB_execSQL("select a.NbCassettes, a.Code from ABONNES a, EMPRES e where a.Code=e.CodeAbonne and e.NoFilm=$n_film and e.NoExemplaire=$n_exemp", $id);
  $tmp = mysql_fetch_object($rep);
  $nb_cassettes = intval($tmp->NbCassettes)-1;
  $code = $tmp->Code;

  $rep = DB_execSQL("update ABONNES set NbCassettes=$nb_cassettes where Code='$code'", $id);

  // MAJ empres
  $rep = DB_execSQL("delete from EMPRES where NoFilm=$n_film and NoExemplaire=$n_exemp and CodeAbonne='$code'", $id);

  echo "<p>Cassettes de nouveau disponible.</p>";
}
else
  echo "<p>La cassette n'est pas empruntée.</p>";
?>
</body>
</html>