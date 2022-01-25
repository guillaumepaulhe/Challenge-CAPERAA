<?php
include "base.php";
error_reporting (E_ALL ^ E_NOTICE);


$email = $_POST['email'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role = $_POST['role'];
?>

<h1>Demande d'inscription en tant qu'entraineur</h1>
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
    <label>Adresse e-mail</label>
    <input type="email" name="email" required>
</div>
<div>
    <label>Rôle :</label>
    <select name="role"> 
        <option value="">Veuillez sélectionner un rôle</option>
        <option value="Entraineur">Entraineur</option>
        <option value="Organisateur">Organisateur</option>
        <option value="Jury">Jury</option>
    </select>
</div>

<input type="submit" name="" value="Valider la demande">
</form>
<?php

if($email!=NULL){

    $token = "5165689944:AAGBqKFtVLRqQkTDN53OlBRZKWJztUu-gJw";

$data = [
    'text' => 'Demande d\'inscriprion pour :
'.$nom.' '.$prenom.' '.$email.' '.'en tant que : '.$role,
    'chat_id' => '1306487306'
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}


?>