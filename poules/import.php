<?php
include "base.php";
include "../fonctions.php";

$_REQUEST['url'] = $_SERVER['REQUEST_URI'];
if (!isset($_SESSION['email'])) {
  header("location: ../login.php?url=" . $_REQUEST['url']);
}
if (get_role($db, $_SESSION['email']) != ("Administrateur" || "Jury")) {
  header("location: ../login.php?url=" . $_REQUEST['url']);
}

?>
<form action="upload.php" method="post" enctype="multipart/form-data" class="inscription">
  <h1>Importer un fichier</h1>
  <br>
  <label class="file-upload" for="file"><span class="material-icons">upload_file</span>Sélectionner un fichier (.json)</label>
  <input class="file" id="file" type="file" name="file" accept=".json" style="display: none;">
  <div class="preview">
    <p>Aucun fichier sélectionné pour le moment</p>
  </div>
  <input class="inscription" type="submit" value="Envoyer" name="submit">
</form>

<script>
  var fileInput = document.getElementById('file');
  fileInput.addEventListener('change', function(e) {
    var file = fileInput.files[0];
    console.log(file.name);
    var preview = document.getElementsByClassName('preview')[0];
    preview.innerHTML = '<p>Fichier Selectionné : "' + file.name + '"</p>';
  });
</script>