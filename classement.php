<?php  
include "base.php";
include "fonctions.php"
?>
<h1>Classement :</h1>
<ul class="case">
	  <?php
        get__classement($db);
?>
    </ul>