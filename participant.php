<?php  
include "base.php";
include "fonctions.php";

if(!isset($_SESSION['email'])){
    header("location: login.php");
  }
?>

<ul class="case">
<?php
    get__participants($db);
?>
</ul>