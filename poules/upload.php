<?php
include("base.php");
if (isset($_POST['submit'])){
    $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileTempName = $_FILES['file']['tmp_name'];
    echo "Fichier selectionné : " . $filename . "<br>";
    $fileSize = $_FILES['file']['size'];
    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));
        if ($fileError == 0 && $fileActualExt == 'json'){
                $fileDestination = 'uploads/'.$filename;
                move_uploaded_file($fileTempName, $fileDestination);
                header('location:read-json.php?file='.$fileDestination.'');

        } else {
            echo "<p class='errorMessage'>Une erreur s'est produite! ou vous n'avez pas choisi un fichier '.json'</p>";
            header("refresh:3;url=import.php");

        }

}

?>