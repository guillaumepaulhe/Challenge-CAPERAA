<?php
include "base.php";
include "fonctions.php";
$club = $_POST['club'];
echo $club;
?>
<form action="" method="post">
<input list="clubs" name="club">
<datalist id="clubs">
<?php
$req = $db->query("SELECT * FROM clubs ORDER BY nom ASC ");
while($data = $req->fetch()){
  echo '<option value="'.$data['nom'].'">';
}
?>
</datalist>  
<input type="submit" value="Valider">
</form>