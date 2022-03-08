<?php  
include "base.php";
include "fonctions.php";
error_reporting (E_ALL ^ E_NOTICE);

  if(!isset($_SESSION['email'])){
    header("location: login.php");
  }
?>

<form action="" method = "post">
<div> 
    <label>Nom</label>
    <input class="ecart_inscription" name="nom" type="text"  >
</div>
<div>
    <label>Prénom</label>
    <input class="ecart_inscription" name="prenom" type="text"  >
</div>
<div>
    <label>Sexe</label>
    <select class="ecart_inscription" name="sexe" id="">
        <option value="">Sélectionnez votre sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>
</div>
<div>
    <label>Age</label>
    <input class="ecart_inscription" name="age" type="text"  >
</div>
<div>
    <label>Taille</label>
    <input class="ecart_inscription" name="taille" type="text"  >
</div>
<div>
    <label>Poids</label>
    <input class="ecart_inscription" name="poids" type="text"  >
</div>
<div>
    <label>Ceinture</label>
    <select class="ecart_inscription" name="Ceinture" id="">
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
</div>


<input class="ecart_inscription" type="submit" name="" value="Valider l'inscription">
</form>
<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$sexe = $_POST['sexe'];
$age = $_POST['age'];
$taille = $_POST['taille'];
$poids = $_POST['poids'];
$ceinture = $_POST['Ceinture'];


if($nom!=NULL){
    add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids,$ceinture);
}


?>