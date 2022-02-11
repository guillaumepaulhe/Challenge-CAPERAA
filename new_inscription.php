<?php
include "base.php";
include "fonctions.php";
if (get_role($db,$_SESSION['email']) != "Administrateur") {
        header("location: login.php");
}
?>

<ul class="case">
	  <?php
      
        get__demandes($db);
        if(array_key_exists('valider', $_POST)) {
            valider();
        }
        if(array_key_exists('refuser', $_POST)) {
            refuser();
        }

        function valider(){
            echo "valider";
        }

        function refuser(){
            echo "refuser";
        }
        
?>
    </ul>