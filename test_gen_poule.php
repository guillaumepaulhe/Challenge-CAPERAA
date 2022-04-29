<?php
include "base.php";
include "fonctions.php";
$poules =1;
function create_poule($db,$nb6,$nb4,$nb5,$nb3,$sexe){
    $offset = 0;
    global $poules;
        for($i=1;$i<=$nb6;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' ORDER BY Poids DESC LIMIT $offset,6" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' ");
                $req_ma_table->execute();
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=6; 
            echo '<br>';
        }
        
        for($i=1;$i<=$nb5;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' ORDER BY Poids DESC LIMIT $offset,5" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND Poule NOT BETWEEN 1 AND '$poules'");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=5; 
            echo '<br>';
        }

        for($i=1;$i<=$nb4;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' ORDER BY Poids DESC LIMIT $offset,4" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id'");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=4; 
            echo '<br>';
        }
        
        for($i=1;$i<=$nb3;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' ORDER BY Poids DESC LIMIT $offset,3" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id'");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=3; 
            echo '<br>';
        }
}




echo 'Homme : <br>';
$nb_participants_homme = get_nb_participants($db,'Homme');

$reste_homme = $nb_participants_homme % 6;

echo 'nombre participants Homme : ' . $nb_participants_homme . '<br>';

echo 'reste calcul homme : '.$reste_homme;
echo '<br>';




if($reste_homme == 0){
    echo 'nombre de poules de 6 Homme : ' . $nb_participants_homme / 6;
    echo '<br>';
    create_poule($db,($nb_participants_homme/6),0,0,0,'Homme');
}

else{

    if($reste_homme >= 3){
        echo 'nombre de poules de 6 Homme : ' . ($nb_participants_homme - $reste_homme) /6 . ' reste : ' . $reste_homme;
        echo ' <br> 1 Poule de ' . $reste_homme . 'Homme';
        echo '<br>';
        echo '<br>';
        $nb_poule_de_6 = ($nb_participants_homme - $reste_homme) /6;
        if($reste_homme == 3) $nb_poule_de_3 = 1;
        if($reste_homme == 4) $nb_poule_de_4 = 1;
        if($reste_homme == 5) $nb_poule_de_5 = 1;
    }
    if($reste_homme == 1){
        echo '<br> nombre de poules de 6 Homme : ' . (($nb_participants_homme - $reste_homme) /6 -1);
        echo '<br> reste  : ' . ($reste_homme + 6) . ' participants Homme';
        echo '<br> Poule de 4 Homme : 1 <br> Poule de 3 Homme : 1 <br> <br>';
        $nb_poule_de_6 = (($nb_participants_homme - $reste_homme) /6 -1);
        $nb_poule_de_5 = 0;
        $nb_poule_de_4 = 1;
        $nb_poule_de_3 = 1;
    }
    if($reste_homme == 2){
        echo '<br> nombre de poules de 6 Homme  : ' . (($nb_participants_homme - $reste_homme) /6 -1);
        echo '<br> reste  : ' . ($reste_homme + 6) . ' participants Homme ';
        echo '<br> Poule de 4 Homme : 2';
        $nb_poule_de_6 = (($nb_participants_homme - $reste_homme) /6 -1);
        $nb_poule_de_5 = 0;
        $nb_poule_de_4 = 2;
        $nb_poule_de_3 = 0;
    }

    create_poule($db,$nb_poule_de_6,$nb_poule_de_4,$nb_poule_de_5,$nb_poule_de_3,'Homme');

}


// ---------------------------femme---------------------------

echo 'Femme : <br>';

$nb_participants_femme = get_nb_participants($db,'Femme');

$reste_femme = $nb_participants_femme % 6;

echo 'nombre participants Femme : ' . $nb_participants_femme . '<br>';

echo 'reste calcul femme : '.$reste_femme;

if($reste_femme == 0){
    echo 'nombre de poules de 6 femme : ' . $nb_participants_femme / 6;
    create_poule($db,($nb_participants_femme/6),0,0,0,'femme');
}

else{

    if($reste_femme >= 3){
        echo 'nombre de poules de 6 femme : ' . ($nb_participants_femme - $reste_femme) /6 . ' reste : ' . $reste_femme;
        echo ' <br> 1 Poule de ' . $reste_femme . 'femme';
        echo '<br>';
        echo '<br>';
        $nb_poule_de_6 = ($nb_participants_femme - $reste_femme) /6;
        if($reste_femme == 3) $nb_poule_de_3 = 1;
        if($reste_femme == 4) $nb_poule_de_4 = 1;
        if($reste_femme == 5) $nb_poule_de_5 = 1;
    }
    if($reste_femme == 1){
        echo '<br> nombre de poules de 6 femme : ' . (($nb_participants_femme - $reste_femme) /6 -1);
        echo '<br> reste  : ' . ($reste_femme + 6) . ' participants femme';
        echo '<br> Poule de 4 femme : 1 <br> Poule de 3 femme : 1 <br> <br>';
        $nb_poule_de_6 = (($nb_participants_femme - $reste_femme) /6 -1);
        $nb_poule_de_5 = 0;
        $nb_poule_de_4 = 1;
        $nb_poule_de_3 = 1;
    }
    if($reste_femme == 2){
        echo '<br> nombre de poules de 6 femme  : ' . (($nb_participants_femme - $reste_femme) /6 -1);
        echo '<br> reste  : ' . ($reste_femme + 6) . ' participants femme ';
        echo '<br> Poule de 4 femme : 2';
        echo '<br>';
        echo '<br>';
        $nb_poule_de_6 = (($nb_participants_femme - $reste_femme) /6 -1);
        $nb_poule_de_5 = 0;
        $nb_poule_de_4 = 2;
        $nb_poule_de_3 = 0;
    }

    create_poule($db,$nb_poule_de_6,$nb_poule_de_4,$nb_poule_de_5,$nb_poule_de_3,'femme');

}

creat

?>

