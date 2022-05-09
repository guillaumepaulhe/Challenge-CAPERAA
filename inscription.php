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

echo $nom_club;
?>

<form class="inscription" action="" method = "post">

    <h1>S'inscrire</h1>
    <input class="inscription" name="nom" type="text" placeholder="Nom" required>

    
    <input class="inscription" name="prenom" type="text" placeholder="Prénom" required>

    
    <input class="inscription" type="email" name="email" placeholder="Adresse e-mail" required>

    
    <input class="inscription" type="password" name="mdp" placeholder="Mot de passe" required>

    
    <select class="inscription" id="role" name="role" onchange="changed_role()" required > 
        <option value="Veuillez sélectionner un rôle">Veuillez sélectionner un rôle</option>
        <option value="Entraineur">Entraineur</option>
        <option value="Organisateur">Organisateur</option>
        <option value="Jury">Jury</option>
    </select>

        <input class="inscription" list="clubs" name="club" id="club" placeholder="Selectionez votre club" style="display: none;">
        <input class="inscription" id="valider" type="submit" name="" value="Valider la demande">
        <datalist id="clubs">
        <?php
        $req = $db->query("SELECT * FROM clubs ORDER BY nom ASC ");
        while($data = $req->fetch()){
        echo '<option value="'.$data['nom'].'">';
        }
        ?>
        </datalist>

    

</form>

<?php
    if($email!=NULL){
    add_demande_inscription($db,$nom,$prenom,$email,$mdp,$role,$nom_club);
    }

?>
