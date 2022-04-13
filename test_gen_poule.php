<?php
include "base.php";
include "fonctions.php";
$nb_poule_base = (($nb_participants - $reste) /6);

function creat_poule($db,$sexe){
        for($i=0;$i<= $nb_poule_base;$i++){
               
                $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND Age BETWEEN 8 AND 11  ORDER BY Poids DESC LIMIT $a,6" );
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();   
                foreach ($result_req_ma_table as $result) {
                    echo 'Nom : '. $result["Nom"];
                }
                $a+6;    
                }
                
            }
creat_poule($db,'Homme');



            $nb_participants = get_nb_participants($db);
            
            $reste = $nb_participants % 6;
            echo 'nombre participants : ' . $nb_participants . '<br>';
            if($reste == 0){
                echo 'nombre de poules de 6 : ' . $nb_participants / 6;
            }
            else{
                if($reste >= 3 ){
                echo 'nombre de poules de 6 : ' . ($nb_participants - $reste) /6 . ' reste : ' . $reste;
                echo ' <br> 1 Poule de ' . $reste ;
                }
                if($reste == 1){
                    echo 'reste :' . $reste;
                    echo '<br> nombre de poules de 6 : ' . (($nb_participants - $reste) /6 -1);
                    echo '<br> reste  : ' . ($reste + 6) . ' participants ';
                    echo '<br> Poule de 4 : 1 <br> Poule de 3 : 1';
                }
                if($reste == 2){
                    echo 'reste :' . $reste;
                    echo '<br> nombre de poules de 6 : ' . (($nb_participants - $reste) /6 -1);
                    echo '<br> reste  : ' . ($reste + 6) . ' participants ';
                    echo '<br> Poule de 4 : 2';
                }
            }
            ?>