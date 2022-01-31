<?php
$db = new PDO('mysql:host=localhost;dbname=caperaa;charset=utf8', 'root', 'root');

// function affiche_classement($db){
// 	$req_ma_table = $db->prepare("SELECT nom FROM classement ORDER BY 'points' ");
// 	$req_ma_table->execute();
// 	$result_req_ma_table = $req_ma_table->fetchAll();
// 	foreach ($result_req_ma_table as $result) {
// 		$res = $result['nom'];
//     }
// }

function get__classement($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants ORDER BY points DESC");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$i++;
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$points = $result['points'];
		if($i==1){
			echo '<li class="classement"> <p class="classement">🥇'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prenom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i==2){
			echo '<li class="classement"> <p class="classement">🥈'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prenom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i==3){
			echo '<li class="classement"> <p class="classement">🥉'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prenom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i >3)
		echo '<li class="classement"> <p class="classement">'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prenom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
	}
}

// function affiche_participants($db){
// 	$req_ma_table = $db->prepare("SELECT Nom FROM participants");
// 	$req_ma_table->execute();
// 	$result_req_ma_table = $req_ma_table->fetchAll();
// 	foreach ($result_req_ma_table as $result) {
// 		$res = $result['Nom'];
// 	}
// }


function get__participants($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$poids = $result['Poids'];
		$taille = $result['Taille'];
		$sexe = $result['Sexe'];

		$edit_nom = $result['Nom'];
		$edit_prenom = $result['Prenom'];
		$edit_poids = $result['Poids'];
		$edit_taille = $result['Taille'];
		$edit_sexe = $result['Sexe'];

		$id =  $result['idParticipant'];
		$file_handle = fopen($id.'.php', 'w');
		// UPDATE participants SET Poids = '105' WHERE idParticipant = '7'
		fwrite($file_handle,'
		<?php
		include "base.php";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST[\'nom\'];
		$edit_prenom = $_POST[\'prenom\'];
		$edit_sexe = $_POST[\'sexe\'];
		$edit_age = $_POST[\'age\'];
		$edit_taille = $_POST[\'taille\'];
		$edit_poids = $_POST[\'poids\'];?> 

		<ul>
		<li class="case"> <form method="post"> <input name="nom" class="case" type="text" value="'.$edit_nom.'"> <input name="prenom" type="text" value="'.$edit_prenom.'"> <input name="poids" type="number" value="'.$edit_poids.'"> <input name="taille" type="number" value="'.$edit_taille.'"> <input name="sexe" type="text" value="'.$edit_sexe.'"> <br><input type="submit" value="Valider"> </form> </li>
		</ul>
		<?php

		echo $edit_nom,"<br>"; 
		echo $edit_prenom,"<br>";
		echo $edit_poids,"<br>";
		echo $edit_taille,"<br>";
		echo $edit_sexe,"<br>";
		?>
		');
		fclose($file_handle);
		echo '<li class="case"> <p class="case">Nom : '.$nom.'</p><p class="case">Prenom : '.$prenom.'</p> <p class="case">Poids : '.$poids." ".' kg</p> <p class="case">Taille : '.$taille.' cm</p> <p class="case">Sexe : '.$sexe.'</p><br><button onclick="location.href=\''.$id.'.php\'" id="'.$id.'" class="case">Modifier</button></li>';
	}
}

function add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids){
    $req_ma_table = $db->prepare("INSERT INTO participants (Nom,Prenom,Sexe,Age,Taille,Poids) VALUES ('$nom','$prenom','$sexe','$age','$taille','$poids')");
	$req_ma_table->execute();
}

// function get_id($db,$nom,$prenom){
//     $req_ma_table = $db->prepare("SELECT idParticipant FROM `participants` WHERE `nom`='$nom' AND `prenom`='$prenom' AND `poids`='$poids'");
// 	$req_ma_table->execute();
// }

    ?>