<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>IdentificationC</title>
</head>
<body>
	<?php 
		include 'Outils.inc'; 
		echo banniere("IdentificationC.php", "Coquart &amp; Bunel"); 
	?>
	<!-- <h1>VIDEO EXPRESS</h1>
	<p>&copy; Coquart &amp; Bunel</p>
	<hr/>
	<ul>
		<li><a href="Accueil.php">Accueil</a></li>
		<li><a href="AccueilDescriptif.php">Descriptif d'un film</a></li>
		<li><a href="AccueilRecherche.php">Recherche de films</a></li>
		<li><a href="IdentificationC.php">Commande de cassettes</a></li>
		<li><a href="IdentificationD.php">Liste des cassettes détenues</a></li>
	</ul> -->
	<br/><br/>
	<form method="POST" action="Commande.php">
	<p>Abonné -> nom : <input type="text" name="NOM" />, n° : <input type="password" name="PASS" /><br/>
	<input type="submit" value="Soumettre"/>
	</p>
	</form>
</body>
</html>
