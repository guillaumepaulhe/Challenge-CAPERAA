<?php  
include "base.php";
include "fonctions.php";
error_reporting (E_ALL ^ E_NOTICE);
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
  if(!isset($_SESSION['email'])){
    header("location: login.php");
  }
?>

<form action="" method = "post" class="inscription">
    <h1>Inscrire un combatant</h1>

    <input class="inscription" name="nom" type="text" placeholder="Nom">
<br>
    <input class="inscription" name="prenom" type="text" placeholder="Prenom">
  <br>
    <input class="inscription" name="age" type="text" placeholder="Age" >
<br>
    <input class="inscription" name="taille" type="text" placeholder="Taille" >
<br>
    <input class="inscription" name="poids" type="text" placeholder="Poids" >
<br>
    <select class="inscription" name="sexe" id="">
        <option value="">Sélectionnez le sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>
    <select class="inscription" name="Ceinture" id="">
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



<input class="inscription" type="submit" name="" value="Valider l'inscription">
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