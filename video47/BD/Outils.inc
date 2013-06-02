<?php
if(isset($_COOKIE['identite']) && $_COOKIE['identite']['nom']!="")
  $tab = array("Accueil.php" => "Accueil", "AccueilDescriptif.php" => "Descriptif d'un film", "AccueilRecherche.php" => "Recherche de films", "Commande.php" => "Commande de cassettes", "Detenues.php" => "Liste des cassettes détenues", "Logout.php" => "Logout");
else
  $tab = array("Accueil.php" => "Accueil", "AccueilDescriptif.php" => "Descriptif d'un film", "AccueilRecherche.php" => "Recherche de films", "IdentificationC.php" => "Commande de cassettes", "IdentificationD.php" => "Liste des cassettes détenues");

function banniere($page, $auteurs) {
  global $tab;
  $text = "<hr/><h1>VIDEO EXPRESS</h1><p>&copy; $auteurs</p><hr/>";
				
  $text .= "<ul>"; 
  foreach($tab as $tmp => $val) {
    if($tmp != $page)
      $text .= "<li><a href=$tmp>$val</a></li>";
  }
  $text .= "</ul><hr/>";
  return $text;
}

function DB_connect() {
  //"poux.ufr-info-p6.jussieu.fr"
  $cnx = mysql_connect("localhost", "video47", "9198");
  if ($cnx == 0) {
    echo "Erreur pour se connecter";
    exit;
  } else {
    if (mysql_select_db("video47", $cnx) == 0) {
      echo "Erreur d'accès à la base";
      exit;
    }
  }
  return $cnx;  
}

function DB_execSQL($req, $serv) {
  $rep = mysql_query($req, $serv);
  if ($rep != 0 )
    return $rep;
  else {
    echo mysql_error($serv);
    exit;
  }
}
?>
