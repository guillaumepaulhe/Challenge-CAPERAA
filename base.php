<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
$db = new PDO('mysql:host=localhost;dbname=caperaa;charset=utf8', 'root', 'root');

function get_rolee($db,$email){
	$req_ma_table = $db->prepare("SELECT Role FROM utilisateurs WHERE email = '$email'");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$role = $result['Role'];
	}
	return $role;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="http://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Logo(2).png">
  <title>Challenge CAPERAA</title>
</head>
<body>
<img src="Banniere.png" width=100% id="baniere">

  <ul class="menu">
    <li class="menu"><a class="menu" href="index.php">Accueil</a></li>
    <li class="menu"><a class="menu" href="classement.php">Classement</a></li>
    
    <?php

    if(!isset($_SESSION['email']) || get_rolee($db,$_SESSION['email']) == "Administrateur"){
      echo '<li class="menu"><a class="menu" href="inscription.php">Inscription</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Entraineur")) {
      echo '<li class="menu"><a class="menu" href="inscription-combatant.php">Inscription combattants</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Organisateur")) {
      echo '<li class="menu"><a class="menu" href="participant.php">Participants</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == "Administrateur") {
     echo '<li class="menu"><a class="menu" href="demande-inscription.php">Inscriptions en attentes</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Jury")) {
      echo '<li class="menu"><a class="menu" href="feuilles-combats.php">Feuilles de combats</a></li>';
     }
    
    if(isset($_SESSION['email'])){
      echo '<li style="float:right"><a class="menu" href="logout.php">Se déconnecter <span class="material-icons icon">logout</span> </a></li>';
    }

    if(!isset($_SESSION['email'])){
      echo '<li style="float:right"><a class="menu" href="login.php">Se connecter <span class="material-icons icon">person</span></a></li>';
    }
    ?>
        <li class="menu"><a class="menu" href="poules.php">Poules</a></li>

  </ul>

  <nav role="navigation">
  <div id="menuToggle">
    <input type="checkbox" />
    <span id="test"></span>
    <span id="test"></span>
    <span id="test"></span>
    <ul id="menu">
    <li class=""><a class="" href="index.php"><span class="material-icons icon">home</span> Accueil </a></li>
    <li class=""><a class="" href="classement.php"><span class="material-icons icon">format_list_bulleted</span> Classement </a></li>
      <?php
    if(!isset($_SESSION['email']) || get_rolee($db,$_SESSION['email']) == "Administrateur"){
      echo '<li class=""><a class="" href="inscription.php"> <span class="material-icons icon">assignment</span> Inscription </a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Entraineur")) {
      echo '<li class=""><a class="" href="inscription-combatant.php">Inscription combattants</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Organisateur")) {
      echo '<li class=""><a class="" href="participant.php">Participants</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == "Administrateur") {
     echo '<li class=""><a class="" href="demande-inscription.php">Inscriptions en attentes</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Jury")) {
      echo '<li class=""><a class="" href="feuilles-combats.php">Feuilles de combats</a></li>';
     }
    
    if(isset($_SESSION['email'])){
      echo '<li><a class="" href="logout.php">Se déconnecter </a></li>';
    }

    if(!isset($_SESSION['email'])){
      echo '<li > <a class="" href="login.php"><span class="material-icons icon">person</span> Se connecter  </a></li>';
    }
      ?>
    </ul>
  </div>
</nav>
