
		<?php
		$db = new PDO("mysql:host=localhost;dbname=caperaa;charset=utf8", "root", "root");
		include "base.php";
		error_reporting (E_ALL ^ E_NOTICE);
		$edit_nom = $_POST['nom'];
		$edit_prenom = $_POST['prenom'];
		$edit_sexe = $_POST['sexe'];
		$edit_age = $_POST['age'];
		$edit_taille = $_POST['taille'];
		$edit_poids = $_POST['poids'];?> 

		<ul>
		<li class="case"> <form method="post"> <input name="nom" class="case" type="text" value="Alonso"> <input name="prenom" type="text" value="Dorian"> <input name="age" type="number" value="19"> <input name="poids" type="number" value="75"> <input name="taille" type="number" value="175"> <input name="sexe" type="text" value="Homme"> <br><input type="submit" value="Valider"> </form> </li>
		</ul>
		<?php

		echo $edit_nom,"<br>"; 
		echo $edit_prenom,"<br>";
		echo $edit_sexe,"<br>";
		echo $edit_age,"<br>";
		echo $edit_poids,"<br>";
		echo $edit_taille,"<br>";
		$edit_req_ma_table = $db->prepare("UPDATE participants SET Poids = 75 WHERE idParticipant = 8");
		$edit_req_ma_table->execute();


		?>
		