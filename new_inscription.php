<?php
include "base.php";
include "fonctions.php";
if (get_role($db,$_SESSION['email']) != "Administrateur") {
        header("location: login.php");
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
		</li>
	    </ul>';

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
			</li>
			</ul>';

		}


		
		
	}
    if(array_key_exists('valider', $_POST)) {
        valider_demande($db,$id,$nom,$prenom,$email,$password,$role,$nom_club);
        refuser_demande($db,$id);

    }
    if(array_key_exists('refuser', $_POST)) {
        refuser_demande($db,$id);
    }
	if($nom == NULL){
		echo '    </ul>';
		echo '<p class=\'center\'> Aucune inscription en attente </p>';
	}
}

function valider_demande($db,$id,$nom,$prenom,$email,$password,$role,$nom_club) {
	$req_ma_table = $db->prepare("INSERT INTO utilisateurs (Nom,Prenom,email,password,Role,Nom_club) VALUES ('$nom','$prenom','$email','$password','$role','$nom_club')");
	$req_ma_table->execute();
	header("Refresh:0");
}

function refuser_demande($db,$id){
	$req_ma_table = $db->prepare("DELETE FROM demande_inscription WHERE `ID` = '$id'");
	$req_ma_table->execute();
    header("Refresh:0");
}

?>

<ul class="case">
	  <?php
      
        get__demandes($db);
        
?>
