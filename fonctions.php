<?php
$db = new PDO('mysql:host=localhost;dbname=caperaa;charset=utf8', 'root', 'root');


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
			echo '<li class="classement"> <p class="classement">🥇'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i==2){
			echo '<li class="classement"> <p class="classement">🥈'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i==3){
			echo '<li class="classement"> <p class="classement">🥉'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
		}
		if($i >3)
		echo '<li class="classement"> <p class="classement">'.$i.'</p> <p class="classement">Nom : '.$nom.'</p><p class="classement">Prénom : '.$prenom.'</p> <p class="classement">Points : '.$points.'</p></li>';
	}
}

function get__demandes($db){
	$req_ma_table = $db->prepare("SELECT * FROM demande_inscription");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	
	foreach ($result_req_ma_table as $result) {
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$email = $result['Email'];
		$password = $result['Mdp'];
		$role  = $result['Role'];
		$nom_club = $result['Nom_club'];
		$id = $result['ID'];
		if($nom_club!=NULL){
		echo '<li class="classement"> 
		<p class="classement">Nom : '.$nom.'</p>
		<p class="classement">Prénom : '.$prenom.'</p>
		<p class="classement">Email : '.$email.'</p>
		<p class="classement">Role : '.$role.'</p>
		<p class="classement">Nom du club : '.$nom_club.'</p> 
		<br>
		<form class="case" method="post">
		<input type="submit" name="valider" class="case" value="✔" />
		<input type="submit" name="refuser" class="case" value="❌" />
		</form>
		</li>';
		}
		if($nom_club == NULL){
			echo '<li class="classement"> 
			<p class="classement">Nom : '.$nom.'</p>
			<p class="classement">Prénom : '.$prenom.'</p>
			<p class="classement">Email : '.$email.'</p>
			<p class="classement">Role : '.$role.'</p>
			<br>
			<form class="case" method="post">
			<input type="submit" name="valider" class="case" value="✔" />
			<input type="submit" name="refuser" class="case" value="❌" />
			</form>
			</li>';
		}
		
	}

}

function valider_demande($db,$id,$nom,$prenom,$email,$password,$role,$nom_club) {
	$req_ma_table = $db->prepare("INSERT INTO utilisateurs (Nom,Prenom,email,password,Role,Nom_club) VALUES ('$nom','$prenom','$email','$password','$role','$nom_club')");
	$req_ma_table->execute();
	
}

function refuser_demande($db){
	$req_ma_table = $db->prepare("DELETE FROM utilisateurs WHERE `idUser` = '$id'");
	$req_ma_table->execute();
}

function get__participants($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$sexe = $result['Sexe'];
		$age = $result['Age'];
		$taille = $result['Taille'];		
		$poids = $result['Poids'];


		$edit_nom = $result['Nom'];
		$edit_prenom = $result['Prenom'];
		$edit_sexe = $result['Sexe'];
		$edit_age = $result['Age'];		
		$edit_taille = $result['Taille'];
		$edit_poids = $result['Poids'];

		

		$id =  $result['idParticipant'];
		$file_handle = fopen($id.'.php', 'w');


		fwrite($file_handle,'
		<?php
		$s = "'.$sexe.'";
		echo $s;
		$db = new PDO("mysql:host=localhost;dbname=caperaa;charset=utf8", "root", "root");
		include "base.php";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST[\'nom\'];
		$edit_prenom = $_POST[\'prenom\'];
		$edit_sexe = $_POST[\'sexe\'];
		$edit_age = $_POST[\'age\'];
		$edit_taille = $_POST[\'taille\'];
		$edit_poids = $_POST[\'poids\'];?> 

		
		
		<form method="post"> 
		<div>
		<label>Nom</label>
		<input class="ecart_inscription" name="nom" class="case" type="text" value="'.$edit_nom.'">
		</div>
		<div>
		<label>Prénom</label> 
		<input class="ecart_inscription" name="prenom" type="text" value="'.$edit_prenom.'">
		</div>
		<div>
		<label>Age</label> 
		<input class="ecart_inscription" name="age" type="number" value="'.$edit_age.'">
		</div>
		<div>
		<label>Poids</label>
		<input class="ecart_inscription" name="poids" type="number" value="'.$edit_poids.'">
		</div>
		<div>
		<label>Taille</label> 
		<input class="ecart_inscription" name="taille" type="number" value="'.$edit_taille.'"> 
		</div>
		<div>
		<label>Sexe</label> 
		<?php
		if ($s == "Homme"){
		echo \'<select class="ecart_inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme" selected >Homme</option>
        <option value="Femme">Femme</option>
    	</select>\';
		} 
		if ($s == "Femme"){
		echo \'<select class="ecart_inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme" selected >Femme</option>
    	</select>\';
	} 
		?>
		<br>
		<div>
		<input class="ecart_inscription" type="submit" value="Valider"> </form> </li>
		</div>
		
		<?php


		$edit_req_ma_table = $db->prepare("UPDATE participants SET Nom = \'$edit_nom\', Prenom = \'$edit_prenom\', Age = $edit_age, Poids = $edit_poids, Taille = $edit_taille, Sexe = \'$edit_sexe\'  WHERE idParticipant = '.$id.'");
		$edit_req_ma_table->execute();


		?>
		');
		
		
		fclose($file_handle);
		echo '<li class="case"> <p class="case">Nom : '.$nom.'</p> <p class="case">Prenom : '.$prenom.'</p> <p class="case">Age : '.$age.'</p> <p class="case">Poids : '.$poids." ".' kg</p> <p class="case">Taille : '.$taille.' cm</p> <p class="case">Sexe : '.$sexe.'</p><br><button onclick="location.href=\''.$id.'.php\'" id="'.$id.'" class="case">Modifier</button></li>';
	}
		
}

function add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids){
    $req_ma_table = $db->prepare("INSERT INTO participants (Nom,Prenom,Sexe,Age,Taille,Poids) VALUES ('$nom','$prenom','$sexe','$age','$taille','$poids')");
	$req_ma_table->execute();
}


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'caperaa');
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

    

function add_demande_inscription($db,$nom,$prenom,$email,$mdp,$role,$nom_club){
    $req_ma_table = $db->prepare("INSERT INTO demande_inscription (Nom,Prenom,Email,Mdp,Role,Nom_club) VALUES ('$nom','$prenom','$email','".hash('sha256', $mdp)."','$role','$nom_club')");
	$req_ma_table->execute();
}

// Connexion à la base de données MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}


function list_club($db){
        $req_ma_table = $db->prepare("SELECT `Nom-du-club` FROM `codes_clubs` ORDER BY `Nom-du-club`");
        $req_ma_table->execute();
        $result_req_ma_table = $req_ma_table->fetchAll();
        foreach ($result_req_ma_table as $result) {
            $club = $result['Nom-du-club'];
            echo '<option value="'.$club.'"> '.$club.'</option>';

		}
}


function get_role($db,$email){
	$req_ma_table = $db->prepare("SELECT Role FROM utilisateurs WHERE email = '$email'");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$role = $result['Role'];
	}
	return $role;
}
    ?>