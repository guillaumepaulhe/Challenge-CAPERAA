<?php
include "base.php";
include "fonctions.php";
error_reporting (E_ALL ^ E_NOTICE);


$email = $_POST['email'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role = $_POST['role'];
$code_club = $_POST['club'];
$mdp = $_POST['mdp'];
?>

<h1>Autre demande d'inscription</h1>
<form action="" method = "post">
<div> 
    <label  >Nom</label>
    <input class="ecart_inscription" name="nom" type="text"  >
</div>

<div>
    <label>Prénom</label>
    <input class="ecart_inscription" name="prenom" type="text"  >
</div>
<div>
    <label>Adresse e-mail</label>
    <input class="ecart_inscription" type="email" name="email" required>
</div>
<div>
    <label>Mot de passe</label>
    <input class="ecart_inscription" type="password" name="mdp" required>
</div>
<div>
    <label>Rôle</label>
    <select class="ecart_inscription" name="role"> 
        <option value="">Veuillez sélectionner un rôle</option>
        <option value="Entraineur">Entraineur</option>
        <option value="Organisateur">Organisateur</option>
        <option value="Jury">Jury</option>
    </select>
</div>
<div>
    <label>Code du club</label>
    <input class="ecart_inscription" name="club" type="number"  >
</div>

<input class="ecart_inscription" type="submit" name="" value="Valider la demande">
</form>
<?php

    if($email!=NULL){
    add_demande_inscription($db,$nom,$prenom,$email,$mdp,$role,$code_club);
    }

?>