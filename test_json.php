<!-- Feuille de Jury pour Poule de 3 -->
<?php  
include "base.php";
$connect = mysqli_connect("localhost", "root", "root", "caperaa"); 
              
    $query = '';
?>


<script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByName('qty');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total').value = tot;
}

    </script>

<?php
if (isset($_FILES['monfichier']['type']) AND $_FILES['monfichier']['error'] == 0)

{
    $myfile = fopen("test.json", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("test.json"));
    fclose($myfile);

    $data = file_get_contents($myfile); 


    // Convert the JSON String into PHP Array
    $array = json_decode($myfile, true); 
    
    // Extracting row by row
    foreach($array as $row) {

        // Database query to insert data 
        // into database Make Multiple 
        // Insert Query 
        // $query .=
        //     "INSERT INTO etudiants VALUES 
        //     ('".$row["nom"]."', '".$row["sexe"]."', 
        //     '".$row["subject"]."'); ";
        // echo "L'envoi a bien été effectué !"; 
    }           

    
}

?>
<form action="" method="post" enctype="multipart/form-data">

<p>

        Formulaire d'envoi de fichier :<br />

        <input type="file" name="monfichier" /><br />

        <input type="submit" value="Envoyer le fichier" />

</p>

</form>

