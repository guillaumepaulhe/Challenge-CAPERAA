<?php  
include "base.php";
include "fonctions.php";
?>
<h1>Classement global</h1>
<ul class="case">
	  <?php
        get__classement($db);
?>
    </ul>
<h1>Classement par poules</h1>