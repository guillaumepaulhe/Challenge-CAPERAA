<?php  
include "base.php";
include "fonctions.php";
include "scroll-top.php";
if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Organisateur" )) {
  header("location: login.php");
}
?>

<form method="post" class="search">
  <span class="material-icons icon search">search</span>
  <input type="search" name="search" id="" class="search" placeholder="Rechercher">
</form>
<?php
  $search = $_POST['search'];
  if($search != NULL){
    echo '<p class = "result">Résultat de la recherche pour : "'.$search.'"</p>';

  }
  ?>
  <ul class="case-participant">
  <?php
  if($search == ""){
    $search = "%";
  }
  afficher_participants($db,$search);
?>
</ul>
