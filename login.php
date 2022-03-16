<?php
include "base.php";
require('fonctions.php');

$count ="";

$url = $_SESSION['url'];


if (isset($_POST['email'])){
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `utilisateurs` WHERE email='$email' and password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['email'] = $email;
      header("Location: ".$url."");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>

<form class="login" action="" method="post" name="login">
<h1>Connexion</h1>
<input class="login" type="email" name="email" placeholder="Adresse e-mail">
<input class="login" type="password" name="password" placeholder="Mot de passe">
<input class="login" type="submit" value="Se connecter" name="submit">
<p>Vous êtes nouveau ici? <a href="new_user.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
