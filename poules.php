<?php
include 'base.php';
include 'fonctions.php';
if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Jury" )) {
    header("location: login.php");
  }
poules($db);
?>