<?php
include "base.php";
require('fonctions.php');
  
if (isset($_POST['email'])){
  $email = stripslashes($_REQUEST['email']);
  $password = stripslashes($_REQUEST['password']);
  $req_ma_table = $db->prepare("SELECT * FROM `utilisateurs` WHERE email='$email' OR Nom='$email' AND password='".hash('sha256', $password)."'");
  $req_ma_table->execute();
  $result_req_ma_table = $req_ma_table->fetchAll();
  foreach ($result_req_ma_table as $result) {
}
  if( ($result['email'] == $email || $result['Nom'] == $email )&& $result['password'] == hash('sha256', $password)){
      $_SESSION['email'] = $result['email'];
      header("Location: index.php");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>

<form class="login" action="" method="post" name="login">
<h1>Connexion</h1>
<input class="login" type="text" name="email" placeholder="Adresse e-mail">
<input class="login" type="password" name="password" placeholder="Mot de passe">
<input class="login" type="submit" value="Se connecter" name="submit">
<p>Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>


