<?php 
include 'Outils.inc';
echo banniere("Logout.php", "Coquart &amp; Bunel"); 

setcookie('identite[nom]');
setcookie('identite[code]');
?>