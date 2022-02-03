<?php  
include "base.php";
include "fonctions.php";

  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion

?>

<div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['email']; ?>!</h1>
    <p>C'est votre tableau de bord.</p>
    <a href="logout.php">Déconnexion</a>
  </div>
<div>
<p class="test">Le challenge Jean-Claude CAPERAA est organisé par le FJEP Lempdes tous les ans le 1er week-end de
décembre. Il s’agit d’un tournoi de judo pour les benjamins et les poussins. Ce challenge est particulier
dans la mesure ou le classement des combattants se fait sur 2 critères, l’expression technique (Yaku Soku
Geiko) et un combat (Randori).
</p>
</div>

<img src="test.png" width= 50% class="center">
