<?php  
include "base.php";
include "fonctions.php";
error_reporting (E_ALL ^ E_NOTICE);

?>

<form action="" method = "post">
<div> 
    <label  >Nom</label>
    <input name="nom" type="text"  >
</div>
<div>
    <label>Prénom</label>
    <input name="prenom" type="text"  >
</div>
<div>
    <label>Sexe :</label>
    <select name="sexe" id="">
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>
</div>
<div>
    <label>Age</label>
    <input name="age" type="text"  >
</div>
<div>
    <label>Taille</label>
    <input name="taille" type="text"  >
</div>
<div>
    <label>Poids</label>
    <input name="poids" type="text"  >
</div>

<input type="submit" name="" value="Se connecter">
</form>

<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$sexe = $_POST['sexe'];
$age = $_POST['age'];
$taille = $_POST['taille'];
$poids = $_POST['poids'];

if($nom!=NULL){
    add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids);
}


?>