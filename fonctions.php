<?php
$db = new PDO('mysql:host=localhost;dbname=caperaa;charset=utf8', 'root', 'root');

function affiche_classement($db){
	$req_ma_table = $db->prepare("SELECT nom FROM classsement ORDER BY 'rank' ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$res = $result['nom'];
    }
	}

function affiche_participants($db){
	$req_ma_table = $db->prepare("SELECT Nom FROM participants");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$res = $result['Nom'];




}
}


function get__participants($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	foreach ($result_req_ma_table as $result) {
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$poids = $result['Poids'];
		$taille = $result['Taille'];
		$sexe = $result['Sexe'];
		echo '<li class="case"> <p class="case">Nom : '.$nom." , ".'</p><p class="case">Prenom : '.$prenom." , ".'</p> <p class="case">Poids : '.$poids." ".' kg, </p> <p class="case">Taille : '.$taille.' cm, </p> <p class="case">Sexe : '.$sexe.'</p></li>';
    }
}


function add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids){
    $req_ma_table = $db->prepare("INSERT INTO participants (Nom,Prenom,Sexe,Age,Taille,Poids) VALUES ('$nom','$prenom','$sexe','$age','$taille','$poids')");
	$req_ma_table->execute();
}

    ?>