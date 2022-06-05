<?php
$db = new PDO('mysql:host=localhost;dbname=caperaa;charset=utf8', 'root', 'root');


function get__classement($db){
	$req_ma_table = $db->prepare("SELECT * FROM participants WHERE points !=0 ORDER BY points DESC");
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


function afficher_participants($db,$search){
	if($search==""){
		$search = "%";
	}
	$req_ma_table = $db->prepare("SELECT * FROM participants WHERE Nom LIKE '%$search%' OR Prenom LIKE '%$search%'");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$res = '';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$nom = $result['Nom'];
		$prenom = $result['Prenom'];
		$sexe = $result['Sexe'];
		$age = $result['Age'];
		$poids = $result['Poids'];
		$club = $result['Nom_club'];
		$ceinture = $result['Ceinture'];


		$edit_nom = $result['Nom'];
		$edit_prenom = $result['Prenom'];
		$edit_sexe = $result['Sexe'];
		$edit_age = $result['Age'];		
		$edit_poids = $result['Poids'];
		$edit_ceinture = $result['Ceinture'];
		

		$id =  $result['idParticipant'];
		$file_handle = fopen('participants/'.$id.'.php', 'w');


		fwrite($file_handle,'
		<?php
		include "base.php";
		include "../fonctions.php";
		if (get_role($db,$_SESSION[\'email\']) != ("Administrateur" || "Organisateur" )) {
			header("location: login.php");
		  }
		$s = "'.$sexe.'";
		$id = "'.$id.'";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = strtoupper($_POST[\'nom\']);
		$edit_prenom = ucfirst(strtolower($_POST[\'prenom\']));
		$edit_sexe = ucfirst(strtolower($_POST[\'sexe\']));
		$edit_age = $_POST[\'age\'];
		$edit_poids = $_POST[\'poids\'];
		$edit_ceinture = ucfirst(strtolower($_POST[\'ceinture\']));
		?> 

		
		<form method="post" class="inscription"> 
		<a class="inscription" href="../participant.php" > <span class="material-icons icon">arrow_back</span> Retour</a>
		<label>Prénom</label> 
		<input class="inscription" name="prenom" type="text" value="'.$edit_prenom.'">
		<label>Nom</label>
		<input class="inscription" name="nom" type="text" value="'.$edit_nom.'">
		<label>Age</label> 
		<input class="inscription" name="age" type="number" value="'.$edit_age.'">
		<label>Poids</label>
		<input class="inscription" name="poids" type="number" value="'.$edit_poids.'">
		<label>Sexe</label> 
		<?php
		if ($s == "Homme"){
		echo \'<select class="inscription" name="sexe" id="" value=Homme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme" selected >Homme</option>
        <option value="Femme">Femme</option>
    	</select>\';
		} 
		if ($s == "Femme"){
		echo \'<select class="inscription" name="sexe" id="" value=Femme required>
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme" selected >Femme</option>
    	</select>\';
	} 
	if(array_key_exists(\'valider\', $_POST)) {
		edit($db,$id,$edit_nom,$edit_prenom,$edit_age,$edit_poids,$edit_sexe,$edit_ceinture);
	}
	if(array_key_exists(\'refuser\', $_POST)) {
		delete_participant_id($db,$id);
	}
		?>
		<label>Ceinture</label> 
		<select class="inscription" name="ceinture" id="">
        <option value="">Sélectionnez votre ceinture</option>
        <option value="blanche">blanche</option>
        <option value="blanche et jaune">blanche et jaune</option>
        <option value="jaune">jaune</option>
        <option value="jaune et orange">jaune et orange</option>
        <option value="orange">orange</option>
        <option value="orange et verte">orange et verte</option>
        <option value="verte">verte</option>
        <option value="verte et bleue">verte et bleue</option>
        <option value="bleue">bleue</option>
        <option value="marron">marron</option>
    	</select>
		<div>
		<input class="inscription" name="valider" type="submit" value="Valider"> 
		<input type="submit" name="refuser" class="inscription" id="refuser" value="Retirer ce combatant" /> </form>



		<?php

		function delete_participant_id($db,$id){
			$req_ma_table = $db->prepare("DELETE FROM participants WHERE `idParticipant` = \'$id\'");
			$req_ma_table->execute();
			unlink($id . \'.php\');
			header("location: ../participant.php");
		}

		function edit($db,$id,$edit_nom,$edit_prenom,$edit_age,$edit_poids,$edit_sexe,$edit_ceinture){
		$edit_req_ma_table = $db->prepare("UPDATE participants SET Nom = \'$edit_nom\', Prenom = \'$edit_prenom\', Age = $edit_age, Poids = $edit_poids, Sexe = \'$edit_sexe\', Ceinture = \'$edit_ceinture\'  WHERE idParticipant =  \'$id\'");
		$edit_req_ma_table->execute();
        header("location: ../participant.php");
		}
		?>
		');
		
		
		fclose($file_handle);
		echo '<li class="case"> <p class="case">Nom : '.$nom.'</p> <p class="case">Prenom : '.$prenom.'</p> <p class="case">Age : '.$age.'</p> <p class="case">Poids : '.$poids." ".' kg</p><p class="case">Sexe : '.$sexe.'</p> <p class = "case">Club :  '.$club.'</p> <p class = "case">Ceinture : '.$ceinture.'</p> <br><button onclick="location.href=\'participants/'.$id.'.php\'" id="'.$id.'" class="modifier">Modifier</button></li>';
	}
		
}

function add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids,$ceinture){
	$nom_club = get_nom_club($db);
    $req_ma_table = $db->prepare("INSERT INTO participants (Nom,Prenom,Sexe,Age,Taille,Poids,Nom_club,Ceinture) VALUES ('$nom','$prenom','$sexe','$age','$taille','$poids','$nom_club','$ceinture')");
	$req_ma_table->execute();
} 

function add_demande_inscription($db,$nom,$prenom,$email,$mdp,$role,$nom_club){
    $req_ma_table = $db->prepare("INSERT INTO demande_inscription (Nom,Prenom,Email,Mdp,Role,Nom_club) VALUES ('$nom','$prenom','$email','".hash('sha256', $mdp)."','$role','$nom_club')");
	$req_ma_table->execute();
}

function list_club($db){
        $req_ma_table = $db->prepare("SELECT `Nom_du_club` FROM `codes_clubs` ORDER BY `Nom_du_club`");
        $req_ma_table->execute();
        $result_req_ma_table = $req_ma_table->fetchAll();
        foreach ($result_req_ma_table as $result) {
            $club = $result['Nom_du_club'];
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

function recupemail($db, $email2){  // Recupère l'adresse mail de l'utilisateur connecté
    $valeur = $db->prepare("SELECT email FROM users WHERE email= '$email2'");
    $valeur->execute();
    $result_valeur = $valeur->fetchAll();
    foreach ($result_valeur as $result ) {
      $valeur = $result['email'];
      return $valeur;
  }}

function get_nom_club($db){
	$email = $_SESSION["email"];
	$req_ma_table = $db->prepare("SELECT `Nom_club` FROM `utilisateurs` WHERE `email`= '$email' ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$nom_club = $result['Nom_club'];
	}
	return $nom_club;
}

function poule($db){
	$req_max_poids = $db->prepare("SELECT MAX(Poids) FROM participants ");
	$req_max_poids->execute();
	$result_req_max_poids = $req_max_poids->fetchAll();
	foreach ($result_req_max_poids as $result) {
	 $max_poids = $result['MAX(Poids)'];
	}
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	$echo = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';
	}
	echo '<br>';
	$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];		
		$echo++;
		echo '<br>';
	}
	echo '<br>';
	$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';
	}
	echo '<br>';
	$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';
	}
	echo '<br>';
	$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';
	}
	echo '<br>';
	$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';
		echo '<br>';}
	$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';}
		$max_poids = $max_poids*0.8;
	$req_ma_table = $db->prepare("SELECT * FROM `participants` WHERE Poids BETWEEN '$max_poids'*0.8 AND '$max_poids' ORDER BY Poids DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	$nb_participant = 0;
	foreach ($result_req_ma_table as $result) {
		$nb_participant++;
		echo $result['Nom'] . " " . $result['Poids'] . " " . $result['Taille'] . " " . $result['Age'];
		$echo++;
		echo '<br>';}
}

function classement_par_club($db){
	$req_ma_table = $db->prepare("SELECT clubs.nom,participants.points FROM clubs,participants WHERE participants.points > 0 AND clubs.nom = participants.Nom_club ORDER BY `clubs`.`nom` ASC");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	echo'<ul class="case">';
	$i = 0;
	foreach ($result_req_ma_table as $result) {
		$club = $result['nom'];
		$req_ma_table2 = $db->prepare("SELECT SUM(points) AS points_club FROM participants WHERE Nom_club = '$club'");
		$req_ma_table2->execute();
		$result_req_ma_table2 = $req_ma_table2->fetchAll();
		foreach ($result_req_ma_table2 as $result2) {
			    $points = $result2['points_club'];
				$req_ma_table3 = $db->prepare("UPDATE clubs SET points = '$points' WHERE nom = '$club'");
				$req_ma_table3->execute();
		}	
	}
    // $req_ma_table = $db->prepare("SELECT clubs.nom,participants.points FROM clubs,participants WHERE clubs.points > 0 AND participants.points = 0 AND clubs.nom = participants.Nom_club");
    // $req_ma_table->execute();
    // $result_req_ma_table = $req_ma_table->fetchAll();
    // foreach ($result_req_ma_table as $result) {
    //         $club = $result['nom'];
    //         $req_ma_table3 = $db->prepare("UPDATE clubs SET points = 0 WHERE nom = '$club'");
    //         $req_ma_table3->execute();
        
        
    // }

    
	$req_ma_table = $db->prepare("SELECT * FROM clubs WHERE points != 0 ORDER BY points DESC ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		if($result['points']!=0){
			$i++;
			if($i==1){
				echo '<li class="classement"> <p class="classement">🥇'.$i.'</p>'. $result['nom'] . ' : ' . $result['points'] . '</p></li>';
			}
			if($i==2){
				echo '<li class="classement"> <p class="classement">🥈'.$i.'</p>'. $result['nom'] . ' : ' . $result['points'] . '</p></li>';
			}
			if($i==3){
				echo '<li class="classement"> <p class="classement">🥉'.$i.'</p>'. $result['nom'] . ' : ' . $result['points'] . '</p></li>';
			}
			if($i >3){
			echo '<li class="classement"> <p class="classement">'.$i. '</p>'. $result['nom'] . ' : ' . $result['points'] . '</p></li>';
		}
		}
	}
}




function get_nb_participants($db,$sexe){
	$req_ma_table = $db->prepare("SELECT COUNT(Nom)AS nb_participants FROM participants WHERE Sexe = '$sexe' ");
	$req_ma_table->execute();
	$result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$nb_participant = $result['nb_participants'];
	}
	return $nb_participant;
}

function poules($db){
	echo '<ul class="poules" style="text-align: center;">';
	$req_ma_table = $db->prepare("SELECT MAX(Poule) FROM participants");
    $req_ma_table->execute();
    $result_req_ma_table = $req_ma_table->fetchAll();
	foreach ($result_req_ma_table as $result) {
		$max_poule = $result['MAX(Poule)'];
	}
	for($i=1;$i<=$max_poule;$i++){
		$req_ma_table = $db->prepare("SELECT * FROM participants WHERE Poule = $i");
		$req_ma_table->execute();
		$result_req_ma_table = $req_ma_table->fetchAll();
		foreach ($result_req_ma_table as $result) {
			$agee = $result['Age'];
			$sexe = $result['Sexe'];
		}
		if($agee == 8 || $agee == 9) $age = 'poussin';
		if($agee == 10 || $agee == 11) $age = 'benjamin';
		echo '<li class="poule" style="list-style-type: none;">';
		echo '<a href=\'poules/poule'.$i.'-'.$sexe.'-'.$age.'.php\'>Fiche Poule n° '.$i.' '.$sexe.' '.$age.'</a>';
		echo '</li>';
	}
	echo '</ul>';

} 

function get_nb_participants_age($db,$sexe,$age){
    if($age == 'poussin'){
        $a = 8;
        $b = 9;
    }
    if($age == 'benjamin'){
        $a = 10;
        $b = 11;
    }
    $req_ma_table = $db->prepare("SELECT COUNT(nom) FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $nb = $result['COUNT(nom)'];
            }
            return $nb;
}


function create_poule($db,$nb6,$nb5,$nb4,$nb3,$sexe,$age){
    $offset = 0;
    if($age == 'poussin'){
        $a = 8;
        $b = 9;
        $c = 'poussin';
        
    }
    if($age == 'benjamin'){
        $a = 10;
        $b = 11;
        $c = 'benjamin';
    }
    global $poules;
        for($i=1;$i<=$nb6;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,6" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' ");
                $req_ma_table->execute();
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=6; 
            echo '<br>';
        }
        for($i=1;$i<=$nb5;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,5" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND age BETWEEN $a AND $b");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=5; 
            echo '<br>';
        }
        for($i=1;$i<=$nb4;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,4" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND age BETWEEN $a AND $b");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=4; 
            echo '<br>';
        }
        for($i=1;$i<=$nb3;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,3" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND age BETWEEN $a AND $b");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=3; 
            echo '<br>';
        }
}

function create_fiches_poules($db){
    $count = 0;
    $noms[5] = array();
    $prenm[5] = array();
    $clubs[5] = array();
    $req_ma_table = $db->prepare("SELECT MAX(Poule) FROM participants");
    $req_ma_table->execute();
    $result_req_ma_table = $req_ma_table->fetchAll();
    foreach ($result_req_ma_table as $result) {
        $max_poule = $result['MAX(Poule)'];
    }
    for($i=1;$i<=$max_poule;$i++){
        $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Poule = $i");
        $req_ma_table->execute();
        $result_req_ma_table = $req_ma_table->fetchAll();
        foreach ($result_req_ma_table as $result) {
            $count++;
            $noms[$count] = $result['Nom'];
            $prenoms[$count] = $result['Prenom'];
            $clubs[$count] = $result['Nom_club'];
            $id[$count] = $result['idParticipant'];
            $poule = $result['Poule'];
            $sexe = $result['Sexe'];
            $agee = $result['Age']; 
        }
        if($agee == 8 || $agee == 9){
            $age = 'poussin';
        }
        if($agee == 10 || $agee == 11){
            $age = 'benjamin';
        }
    if($count == 6){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $id = '.var_export($id, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>
        <h1>Poule   n° <?php echo $poule?> ('.$age.' '.strtolower($sexe).')</h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>
        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">

        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total" class="score_combat">Total technique</p>
        <p id="randori" class="score_combat">Combat RANDORI</p>
        </div>


        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
        <div class="combatant">
            <p class="text_feuille">A1 :  </p>
            <p><?php
            echo $prenoms[1];
            ?>
            </p>
            <p><?php
            echo $noms[1];
            ?>
            </p>
            <p><?php
            echo $clubs[1];
            ?>
            </p>
        </div>

        <div class="combatant">
            <p class="text_feuille">A2 :  </p>
            <p><?php
            echo $prenoms[2];
            ?>
            </p>
            <p><?php
            echo $noms[2];
            ?>
            </p>
            <p><?php
            echo $clubs[2];
            ?>
            </p>

        </div>

        <div class="combatant">
            <p class="text_feuille">B3 :  </p>
            <p><?php
            echo $prenoms[3];
            ?>
            </p>
            <p><?php
            echo $noms[3];
            ?>
            </p>
            <p><?php
            echo $clubs[3];
            ?>
            </p>
        </div>  


        <div class="combatant">
            <p class="text_feuille">B4 :  </p>
            <p><?php
            echo $prenoms[4];
            ?>
            </p>
            <p><?php
            echo $noms[4];
            ?>
            </p>
            <p><?php
            echo $clubs[4];
            ?>
            </p>
        </div>  

        <div class="combatant">
            <p class="text_feuille">C5 :  </p>
            <p><?php
            echo $prenoms[5];
            ?>
            </p>
            <p><?php
            echo $noms[5];
            ?>
            </p>
            <p><?php
            echo $clubs[5];
            ?>
            </p>
        </div>  

        <div class="combatant">
            <p class="text_feuille">C6 :  </p>
            <p><?php
            echo $prenoms[6];
            ?>
            </p>
            <p><?php
            echo $noms[6];
            ?>
            </p>
            <p><?php
            echo $clubs[6];
            ?>
            </p>
        </div> 
        </div>

        <div class="cases">

        <div class="case-1">
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1"></input>
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2"></input>
        <input type="number" name="qtyb3"  class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3"> </input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4"></input>
        <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input disabled class="grid-btn" id="noir" ></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc5" id="totalc5"></input>
        <input type="number" name="qtyc6" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc6\',\'totalc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\')"></input>
        <input type="number" name="qtyc6" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc6\',\'totalc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\')"></input>
        <input disabled class="grid-btn" id="noir" ></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc6" id="totalc6"></input>
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal(\'qtyrandc6\',\'totalrandc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal(\'qtyrandc6\',\'totalrandc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\'),classement6(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\',\'totalrandtechc5\',\'totalrandtechc6\'),coockies_points6(),show_confirm()"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        </div>

        </div>
        <div class="case-3">
        <input disabled type="number" class="grid-btn" name="totalranda1" id="totalranda1"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha1" id="totalrandtecha1"></input>
        <input disabled type="number" class="grid-btn" name="ranka1" id="ranka1"></input>
        <input disabled type="number" class="grid-btn" name="totalranda2" id="totalranda2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha2" id="totalrandtecha2"></input>
        <input disabled type="number" class="grid-btn" name="ranka2" id="ranka2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb3" id="totalrandb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb3" id="totalrandtechb3"></input>
        <input disabled type="number" class="grid-btn" name="rankb3" id="rankb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb4" id="totalrandb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb4" id="totalrandtechb4"></input>
        <input disabled type="number" class="grid-btn" name="rankb4" id="rankb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandc5" id="totalrandc5"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechc5" id="totalrandtechc5"></input>
        <input disabled type="number" class="grid-btn" name="rankc5" id="rankc5"></input>
        <input disabled type="number" class="grid-btn" name="totalrandc6" id="totalrandc6"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechc6" id="totalrandtechc6"></input>
        <input disabled type="number" class="grid-btn" name="rankc6" id="rankc6"></input>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form>
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A/B B/C A/C</p>
        <p>Randoris compétition : 1/3 2/6 1/5 4/6 3/5 2/4</p>
        </div>
        
        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\'],
            4 => $_COOKIE[\'pointsb4\'],
            5 => $_COOKIE[\'pointsc5\'],
            6 => $_COOKIE[\'pointsc6\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=6;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }

        ?>
                
            ');
            }
            if($count == 5){
                $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
                // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
                fwrite($file_handle,'<?php
                $noms = '.var_export($noms, true).';
                $prenoms = '.var_export($prenoms, true).';
                $clubs = '.var_export($clubs, true).';
                $poule = '.$poule.';
                include "base.php";
                ?>
                <h1>Poule   n° <?php echo $poule?> ('.$age.' '.$sexe.')</h1>
                <div class="duree">
                <p>Durée d\'un Randori technique: 1 minute</p>
                <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
                </div>

                <div class="entete">
                    <div class="bb">
                        <p>Compétiteurs appelés</p>
                        <p>Récompences distribuées</p>
                        <p>Fiche saisie</p>
                    </div>
                <div class="aa">
                    <input type="checkbox" class="grid-btn"> 
                    <input type="checkbox" class="grid-btn"> 
                    <input type="checkbox" class="grid-btn"> 
                </div>
                </div>

                <div class="grid-container">
                <div class="infos_combat">
                <p></p>
                <p>Nom</p>
                <p>Prénom</p>
                <p>Club</p>
                </div>

                <div class="score_combat">
                <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
                <p id="total" class="score_combat">Total technique</p>
                <p id="randori" class="score_combat">Combat RANDORI</p>
                </div>

                <div class="total_combat">
                <p class="total_combat">Total RANDORI</p>
                <p class="total_combat">Total technique + Randori</p>
                <p class="total_combat">Classement</p>
                </div>
                    
                <div class="grid-text"> 
                <div class="combatant">
                    <p class="text_feuille">A1 :  </p>
                    <p><?php
                    echo $prenoms[1];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[1];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[1];
                    ?>
                    </p>
                </div>

                <div class="combatant">
                    <p class="text_feuille">A2 :  </p>
                    <p><?php
                    echo $prenoms[2];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[2];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[2];
                    ?>
                    </p>

                </div>

                <div class="combatant">
                    <p class="text_feuille">B3 :  </p>
                    <p><?php
                    echo $prenoms[3];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[3];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[3];
                    ?>
                    </p>
                </div>  


                <div class="combatant">
                    <p class="text_feuille">B4 :  </p>
                    <p><?php
                    echo $prenoms[4];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[4];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[4];
                    ?>
                    </p>
                </div>  

                <div class="combatant">
                    <p class="text_feuille">C5 :  </p>
                    <p><?php
                    echo $prenoms[5];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[5];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[5];
                    ?>
                    </p>
                </div>  
                </div>

                <div class="cases">

                <div class="case-1">
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
                <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
                <input disabled type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number"  name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
                <input type="number"  name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
                <input disabled type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2"></input>
                <input type="number"  name="qtyb3" class="grid-btn" min=0 max=10  onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number"  name="qtyb3" class="grid-btn" min=0 max=10  onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
                <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3" ></input>
                <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
                <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4"></input>
                <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
                <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
                <input class="grid-btn" id="noir" disabled ></input>
                <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc5" id="totalc5"></input>
                </div>

                <div class="case-2">
                <input class="grid-btn" id="noir" disabled ></input>
                <input class="grid-btn" id="noir" disabled ></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
                <input class="grid-btn" id="noir" disabled ></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled ></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')" ></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')" ></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\'),classement5(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\',\'totalrandtechc5\'),coockies_points5(),show_confirm()"></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                <input class="grid-btn" id="noir" disabled></input>
                </div>

                </div>
                <div class="case-3">
                <input disabled type="number" class="grid-btn" name="totalranda1" id="totalranda1"></input>
                <input disabled type="number" class="grid-btn" name="totalrandtecha1" id="totalrandtecha1"></input>
                <input disabled type="number" class="grid-btn" name="ranka1" id="ranka1"></input>
                <input disabled type="number" class="grid-btn" name="totalranda2" id="totalranda2"></input>
                <input disabled type="number" class="grid-btn" name="totalrandtecha2" id="totalrandtecha2"></input>
                <input disabled type="number" class="grid-btn" name="ranka2" id="ranka2"></input>
                <input disabled type="number" class="grid-btn" name="totalrandb3" id="totalrandb3"></input>
                <input disabled type="number" class="grid-btn" name="totalrandtechb3" id="totalrandtechb3"></input>
                <input disabled type="number" class="grid-btn" name="rankb3" id="rankb3"></input>
                <input disabled type="number" class="grid-btn" name="totalrandb4" id="totalrandb4"></input>
                <input disabled type="number" class="grid-btn" name="totalrandtechb4" id="totalrandtechb4"></input>
                <input disabled type="number" class="grid-btn" name="rankb4" id="rankb4"></input>
                <input disabled type="number" class="grid-btn" name="totalrandc5" id="totalrandc5"></input>
                <input disabled type="number" class="grid-btn" name="totalrandtechc5" id="totalrandtechc5"></input>
                <input disabled type="number" class="grid-btn" name="rankc5" id="rankc5"></input>
                <p></p>
                <form action="" class="vfiche"  method="post">
                <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
                </form>
                </div>

                <div class="zebi">
                <p>Randoris Techniques : Couples A/B A1C5/A2B5 B3/C5</p>
                <p>Randoris compétition : 1/3 1/5 4/5 2/4 2/3</p>
                </div>

                <?php

                $points = array (
                    1 => $_COOKIE[\'pointsa1\'],
                    2 => $_COOKIE[\'pointsa2\'],
                    3 => $_COOKIE[\'pointsb3\'],
                    4 => $_COOKIE[\'pointsb4\'],
                    5 => $_COOKIE[\'pointsc5\']
                );
            
                function testt($db){
                    global $points;
                    global $id;
                    for($i=1;$i<=5;$i++){
                        $a = $points[$i];
                        $b = $id[$i];
                        $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                        $req_ma_table->execute();
                        $result_req_ma_table = $req_ma_table->fetchAll();
                    }
                }
                if(array_key_exists(\'testt\',$_POST)){
                        testt($db);
                }

        ?>
        ');
    }
    if($count == 4){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>
        <h1>Poule   n° <?php echo $poule?> ('.$age.' '.$sexe.')</h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>
        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">
        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total" class="score_combat">Total technique</p>
        <p id="randori" class="score_combat">Combat RANDORI</p>
        </div>

        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
        <div class="combatant">
            <p class="text_feuille">A1 :  </p>
            <p><?php
            echo $prenoms[1];
            ?>
            </p>
            <p><?php
            echo $noms[1];
            ?>
            </p>
            <p><?php
            echo $clubs[1];
            ?>
            </p>
        </div>

        <div class="combatant">
            <p class="text_feuille">A2 :  </p>
            <p><?php
            echo $prenoms[2];
            ?>
            </p>
            <p><?php
            echo $noms[2];
            ?>
            </p>
            <p><?php
            echo $clubs[2];
            ?>
            </p>

        </div>

        <div class="combatant">
            <p class="text_feuille">B3 :  </p>
            <p><?php
            echo $prenoms[3];
            ?>
            </p>
            <p><?php
            echo $noms[3];
            ?>
            </p>
            <p><?php
            echo $clubs[3];
            ?>
            </p>
        </div>  


        <div class="combatant">
            <p class="text_feuille">B4 :  </p>
            <p><?php
            echo $prenoms[4];
            ?>
            </p>
            <p><?php
            echo $noms[4];
            ?>
            </p>
            <p><?php
            echo $clubs[4];
            ?>
            </p>
        </div>  

        </div>

        <div class="cases">

        <div class="case-1">
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2" disabled></input>
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3" disabled ></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4" disabled></input>
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\'),classement4(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\'),coockies_points4(),show_confirm()"> </input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        </div>

        </div>
        <div class="case-3">
        <input disabled type="number" class="grid-btn" name="totalranda1" id="totalranda1"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha1" id="totalrandtecha1"></input>
        <input disabled type="number" class="grid-btn" name="ranka1" id="ranka1"></input>
        <input disabled type="number" class="grid-btn" name="totalranda2" id="totalranda2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha2" id="totalrandtecha2"></input>
        <input disabled type="number" class="grid-btn" name="ranka2" id="ranka2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb3" id="totalrandb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb3" id="totalrandtechb3"></input>
        <input disabled type="number" class="grid-btn" name="rankb3" id="rankb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb4" id="totalrandb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb4" id="totalrandtechb4"></input>
        <input disabled type="number" class="grid-btn" name="rankb4" id="rankb4"></input>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form>
        
        </div>
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A/B A1B3/A2B4</p>
        <p>Randoris compétition : 1/3 1/4 2/4 2/3</p>
        </div>
        
        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\'],
            4 => $_COOKIE[\'pointsb4\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=4;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }
        ?>
        ');
    }
    if($count == 3){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>

        <h1>Poule   n° <?php echo $poule?> ('.$age.' '.$sexe.')</h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>
        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">

        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total_score" class="score_combat">Total technique</p></div>
        <p id="randori" class="score_combat">Combat RANDORI</p>


        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
                <div class="combatant">
                    <p class="text_feuille">A1 :  </p>
                    <p><?php
                    echo $prenoms[1];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[1];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[1];
                    ?>
                    </p>
                </div>

                <div class="combatant">
                    <p class="text_feuille">A2 :  </p>
                    <p><?php
                    echo $prenoms[2];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[2];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[2];
                    ?>
                    </p>

                </div>

                <div class="combatant">
                    <p class="text_feuille">B3 :  </p>
                    <p><?php
                    echo $prenoms[3];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[3];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[3];
                    ?>
                    </p>

                </div>  
        </div>

        <div class="cases">

        <div class="case-1">
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')">
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')">
        <input type="number" class="grid-btn" name="totala1" id="totala1" disabled>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')">  
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"> 
        <input type="number" name="totala2" id="totala2" class="grid-btn" min=0 max=10 disabled> 
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"> 
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="totalb3" id="totalb3" class="grid-btn" disabled> 
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled > 
        <input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"> 
        <input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"> 
        <input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\'),classement3(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\'),coockies_points3(),show_confirm()"> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled>     
        <input class="grid-btn" id="noir" disabled> 
        </div>

        </div>


        <div class="case-3">
        <input type="number" name="totalranda1" id="totalranda1" class="grid-btn" disabled > 
        <input type="number" name="totalrandtecha1" id="totalrandtecha1" class="grid-btn" disabled > 
        <input type="number" name="ranka1" id="ranka1" class="grid-btn" disabled> 
        <input type="number" name="totalranda2" id="totalranda2" class="grid-btn" disabled> 
        <input type="number" name="totalrandtecha2" id="totalrandtecha2" class="grid-btn"  disabled> 
        <input type="number" name="ranka2" id="ranka2" class="grid-btn"  disabled> 
        <input type="number" name="totalrandb3" id="totalrandb3" class="grid-btn"  disabled> 
        <input type="number" name="totalrandtechb3" id="totalrandtechb3" class="grid-btn"  disabled> 
        <input type="number" name="rankb3" id="rankb3" class="grid-btn"  disabled>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form> 
        </div>

        </div>
        <div class="zebi">
            <p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
            <p>Randoris compétition : 1/3 1/2 2/3</p>
        </div>
        
        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=3;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }

        ?>');
    }
        $count = 0;
    }
}

function reset_poules($db){
	$req_ma_table2 = $db->prepare("SELECT MAX(Poule) FROM participants");
    $req_ma_table2->execute();
    $result_req_ma_table2 = $req_ma_table2->fetchAll();
	foreach ($result_req_ma_table2 as $result) {
		$max_poule = $result['MAX(Poule)'];
	}

    for($i=1;$i<=$max_poule;$i++){
        if (file_exists("poules/poule".$i."-Homme-poussin.php")){
            unlink("poules/poule".$i."-Homme-poussin.php"); 
        }
        if (file_exists("poules/poule".$i."-Femme-poussin.php")) {
            unlink("poules/poule".$i."-Femme-poussin.php"); 
        }
        if (file_exists("poules/poule".$i."-Homme-benjamin.php")) {
            unlink("poules/poule".$i."-Homme-benjamin.php"); 
        }
        if (file_exists("poules/poule".$i."-Femme-benjamin.php")) {
            unlink("poules/poule".$i."-Femme-benjamin.php");
        }
    }
    $req_ma_table = $db->prepare("UPDATE participants SET Poule = NULL");
    $req_ma_table->execute();
    $result_req_ma_table = $req_ma_table->fetchAll();}

?>