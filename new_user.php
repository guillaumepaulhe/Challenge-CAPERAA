<?php
include "base.php";
error_reporting (E_ALL ^ E_NOTICE);


$email = $_POST['email'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role = $_POST['role'];
$club = $_POST['club'];
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

    $token = "5165689944:AAGBqKFtVLRqQkTDN53OlBRZKWJztUu-gJw";

$data = [
    'text' => 'Demande d\'inscriprion pour :
    '.$nom.' '.$prenom.' '.$email.' '.'en tant que : '.$role.' avec le code de club '.$club,
    'chat_id' => '1306487306'
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}

?>