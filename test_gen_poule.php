<?php
include "base.php";
include "fonctions.php";
$poules =1;
function create_poule($db,$taille_poule,$nb_poule,$sexe){
    $a = 0;
    global $poules;

        for($i=1;$i <= $nb_poule ;$i++){
                $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' ORDER BY Poids DESC LIMIT $a,$taille_poule" );
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
                if($nb_poule == 1){
                    foreach ($result_req_ma_table as $result) {
                        $id = $result['idParticipant'];
                        $req_ma_table = $db->prepare("UPDATE participants SET Poule = $poules WHERE idParticipant = '$id' AND Poule NOT BETWEEN 1 AND '$poules'" );
                        $req_ma_table->execute();   
                        echo 'Nom : '. $result["Nom"];  
                        echo '<br> Prenom : '. $result["Prenom"];
                        echo '<br> Poids : '. $result["Poids"];
                        echo '<br> Poule : '. $result["Poule"];
                        echo '<br>';
                        echo '<br>';
                    }
  

                }        
                else{
                    foreach ($result_req_ma_table as $result) {
                        $id = $result['idParticipant'];
                        $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' ");
                        $req_ma_table->execute();   
                        echo 'Nom : '. $result["Nom"];  
                        echo '<br> Prenom : '. $result["Prenom"];
                        echo '<br> Poids : '. $result["Poids"];
                        echo '<br> Poule : '. $result["Poule"];
                        echo '<br>';
                        echo '<br>';

                    }

                }
                
                $poules++;
                $a+=$taille_poule; 

                }
                echo '<br>';

}



$nb_participants_homme = get_nb_participants($db,'Homme');
$nb_participants_femme = get_nb_participants($db,'Femme');

$reste_homme = $nb_participants_homme % 6;
$reste_femme = $nb_participants_femme % 6;

echo 'nombre participants Homme : ' . $nb_participants_homme . '<br>';
echo 'nombre participants Femme : ' . $nb_participants_femme . '<br>';

echo 'reste calcul homme : '.$reste_homme;
echo '<br>';
echo 'reste calcul femme : '.$reste_femme;
echo '<br>';


if($reste_homme == 0){
    echo 'nombre de poules de 6 Homme : ' . $nb_participants_homme / 6;
    create_poule($db,6,($nb_participants_homme/6),'Homme');
}
else{
    if($reste_homme >= 3){
        echo 'nombre de poules de 6 Homme : ' . ($nb_participants_homme - $reste_homme) /6 . ' reste : ' . $reste;
        echo ' <br> 1 Poule de ' . $reste_homme . 'Homme';
    }
    if($reste_homme == 1){
        echo '<br> nombre de poules de 6 Homme : ' . (($nb_participants_homme - $reste_homme) /6 -1);
        echo '<br> reste  : ' . ($reste_homme + 6) . ' participants Homme';
        echo '<br> Poule de 4 Homme : 1 <br> Poule de 3 Homme : 1 <br> <br>';
        create_poule($db,6,(($nb_participants_homme - $reste_homme) /6 -1),'Homme');
        echo $poules . '<br>'   ;
        // create_poule($db,4,1,'Homme');
        // create_poule($db,3,1,'Homme');
    }
    if($reste_homme == 2){
        echo '<br> nombre de poules de 6 Homme  : ' . (($nb_participants_homme - $reste_homme) /6 -1);
        echo '<br> reste  : ' . ($reste_homme + 6) . ' participants Homme ';
        echo '<br> Poule de 4 Homme : 2';
    }
}

if($reste_femme == 0){
    echo '<br> nombre de poules de 6 Femme : ' . $nb_participants_femme / 6;
    // create_poule($db,6,($nb_participants_femme/6),'Femme');
}
else{
    if($reste_femme >= 3){
        echo 'nombre de poules de 6 Femme : ' . ($nb_participants_femme - $reste_femme) /6 . ' reste : ' . $reste;
        echo ' <br> 1 Poule de ' . $reste_femme . 'Femme';
    }
    if($reste_femme == 1){
        echo '<br> nombre de poules de 6 Femme : ' . (($nb_participants_femme - $reste_femme) /6 -1);
        echo '<br> reste  : ' . ($reste_femme + 6) . ' participants Femme';
        echo '<br> Poule de 4 Femme : 1 <br> Poule de 3 Femme : 1 <br>';
    }
    if($reste_femme == 2){
        echo '<br> nombre de poules de 6 Femme  : ' . (($nb_participants_femme - $reste_femme) /6 -1);
        echo '<br> reste  : ' . ($reste_femme + 6) . ' participants Femme ';
        echo '<br> Poule de 4 Femme : 2';
    }
}




?>

