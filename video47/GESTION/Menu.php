<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Menu Admin</title>
   </head>
   <body>
   <?php
   $tab = array ("ab" => "123", "cd" => "456");

$NOM=$_POST["NOM"];
$PASS=$_POST["PASS"];
if($tab[$NOM]==$PASS)
  echo "<ul><li><a href=\"AccueilRetour.php\">Retour de cassettes</a></li><li>Enregistrer de nouveaux abonnés</li><li>Modifier des fiches d'abonnés</li><li>Radier des abonnés</li></ul>";
else
  echo "<p>Identification raté -> <a href=\"index.htm\">Retour</a></p>";
?>
<!-- 	<ul>
<li><a href="AccueilRetour.php">Retour de cassettes</a></li>
  <li>Enregistrer de nouveaux abonnés</li>
  <li>Modifier des fiches d'abonnés</li>
		<li>Radier des abonnés</li>
	</ul> -->
</body>
</html>
