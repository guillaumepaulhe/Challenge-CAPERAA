<?php
include_once 'base.php';
include_once 'fonctions.php';
function delete_user($db,$id){
    $req_ma_table = $db->prepare("DELETE FROM demande_inscription WHERE ID = $id");
    $req_ma_table->execute();
    header("Refresh:0");
}
function afficher_users($db){
    $req_ma_table = $db->prepare("SELECT * FROM utilisateurs" );
    $req_ma_table->execute();
    $result_req_ma_table = $req_ma_table->fetchAll();
    foreach ($result_req_ma_table as $result) {
        echo '<div class="card-users">
        <div class="pp-users">
                <span class="material-icons">person</span>
                <span id="edit" class="material-icons" style="display: none;">edit</span>
        </div>
        <div class="nom-users" id="'.$result['idUser'].'">';
        if($result["Nom"] == NULL) echo '<p> N/A </p>';
        if($result["Prenom"] == NULL) echo '<p> N/A </p>';
        if($result["Role"] == NULL) echo '<p> N/A </p>';
        
          echo  '<p>'.$result['Nom'].'</p>
        <p>'.$result['Prenom'].'</p>
        <p>'.$result['Role'].'</p>
        <form method="post">
        <input type="submit" name="valider'.$result['idUser'].'" class="case material-icons" value="edit" id="valider"/>
        <input type="submit" name="refuser'.$result['idUser'].'" class="case material-icons " value="delete" id="refuser"/>
        </form>
        </div>
        </div>';
    }
}
// if(array_key_exists('valider', $_POST)) {
//     edit_user($db,$id,$nom,$prenom,$email,$password,$role,$nom_club);
//     refuser_demande($db,$id);
// }

if(array_key_exists('refuser', $_POST)) {
    delete_user($db,$id);
}


?>

<!-- <h1>Gérer les utilisateurs</h1>
<div class="card-users">
    <div class="pp-users">
        <span class="material-icons">person</span>
    </div>
    <div class="nom-users">
        <p>Guillaume</p>
    </div>
</div> -->
<div class="grid-users">

<?php
afficher_users($db);
?>
</div>