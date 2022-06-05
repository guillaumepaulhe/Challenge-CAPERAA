<?php  
include "base.php";
include "fonctions.php";
echo $_SESSION['email'];
if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Entraineur" )) {
  header("location: login.php");
}
error_reporting (E_ALL ^ E_NOTICE);
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
  if(!isset($_SESSION['email'])){
    header("location: login.php");
  }
?>

<form action="" method = "post" class="inscription">
    <h1>Inscrire un combatant</h1>
    <input required class="inscription" name="nom" type="text" placeholder="Nom">
    <input required class="inscription" name="prenom" type="text" placeholder="Prenom">
    <input required class="inscription" name="age" type="number" placeholder="Age" >
    <input required class="inscription" name="taille" type="number" placeholder="Taille" >
    <input required class="inscription" name="poids" type="number" placeholder="Poids" >

    <select required class="inscription" name="sexe" id="">
        <option value="">Sélectionnez le sexe</option>
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>

    <select required class="inscription" name="Ceinture">
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
$nom = strtoupper($_POST['nom']);
$prenom = ucfirst(strtolower($_POST['prenom']));
$sexe = ucfirst(strtolower($_POST['sexe']));
$age = $_POST['age'];
$taille = $_POST['taille'];
  $poids = $_POST['poids'];
  $ceinture = ucfirst($_POST['Ceinture']);
if($nom!=NULL){
    add_participants($db,$nom,$prenom,$sexe,$age,$taille,$poids,$ceinture);
}
?>