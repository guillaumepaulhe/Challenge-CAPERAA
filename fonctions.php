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
function get__participant($nom){
	$req_ma_table = $db->prepare("SELECT * FROM participants WHERE 'nom' = ".'$nom'."");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$res = $result['*'];
    }
}


function add_participants($db,$nom,$prenom,$age,$sexe,$taille,$poids){
    $req_ma_table = $db->prepare("INSERT INTO participants (Nom,Prenom,Age,Sexe,Taille,Poids) VALUES ('$nom','$prenom','$sexe','$age','$taille','$poids')");
	$req_ma_table->execute();
}

    ?>