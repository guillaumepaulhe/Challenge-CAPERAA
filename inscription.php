<?php
include "base.php";
include "fonctions.php";
error_reporting (E_ALL ^ E_NOTICE);


$email = $_POST['email'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role = $_POST['role'];
$nom_club = $_POST['club'];
$mdp = $_POST['mdp'];
?>

<form class="inscription" action="" method = "post">

    <h1>S'inscrire</h1>
    <input class="inscription" name="nom" type="text" placeholder="Nom" required>

    
    <input class="inscription" name="prenom" type="text" placeholder="Prénom" required>

    
    <input class="inscription" type="email" name="email" placeholder="Adresse e-mail" required>

    
    <input class="inscription" type="password" name="mdp" placeholder="Mot de passe" required>

    
    <select class="inscription" name="role" required> 
        <option value="">Veuillez sélectionner un rôle</option>
        <option value="Entraineur">Entraineur</option>
        <option value="Organisateur">Organisateur</option>
        <option value="Jury">Jury</option>
    </select>

    
    <select name="club" class="inscription" >
        <option value="">Entrer le club seulement pour les entraineurs</option>
        <?php 
        list_club($db);
        ?>
    </select>

<input class="inscription" type="submit" name="" value="Valider la demande">
</form>

<?php
    if($email!=NULL){
    add_demande_inscription($db,$nom,$prenom,$email,$mdp,$role,$nom_club);
    }

?>