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
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Logo(2).png">
  <title>Challenge CAPERAA</title>
</head>
<body>
<img src="Banniere.png" width="100%">

  <ul class="menu">
    <li class="menu"><a class="menu" href="index.php">Accueil</a></li>
    <li class="menu"><a class="menu" href="classement.php">Classement</a></li>
    
    
    

    <?php

    if(!isset($_SESSION['email']) || get_rolee($db,$_SESSION['email']) == "Administrateur"){
      echo '<li class="menu"><a class="menu" href="new_user.php">Inscription</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Entraineur")) {
      echo '<li class="menu"><a class="menu" href="inscription.php">Inscription combattants</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == ("Administrateur" || "Organisateur")) {
      echo '<li class="menu"><a class="menu" href="participant.php">Participants</a></li>';
    }

    if (get_rolee($db,$_SESSION['email']) == "Administrateur") {
     echo '<li class="menu"><a class="menu" href="new_inscription.php">Inscriptions en attentes</a></li>';
    }
    
    if(isset($_SESSION['email'])){
    echo '<li style="float:right"><a class="menu" href="logout.php">Déconnexion</a></li>';
    echo '<li style="float:right"><a class="menu" href="">'.$_SESSION['email'].'</a></li>';
    }

    if(!isset($_SESSION['email'])){
     echo '<li style="float:right"><a class="menu" href="login.php">Se connecter</a></li>';
    }
    ?>
  </ul>

<footer>
  <p>&copy; FJEP Lempdes 2022</p>
</footer>