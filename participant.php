<?php  
include "base.php";
include "fonctions.php";
if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Organisateur" )) {
  header("location: login.php");
}
?>

<ul class="case">
<?php
    get__participants($db);
?>
</ul>
