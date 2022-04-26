<?php
include "base.php";
include "fonctions.php";

$req_ma_table = $db->prepare("SELECT * FROM participants ORDER BY Poule" );
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
                    foreach ($result_req_ma_table as $result) {
                        $id = $result['idParticipant'];
                        $req_ma_table = $db->prepare("UPDATE participants SET Poule = $poules WHERE idParticipant = $id ");
                        $req_ma_table->execute();
                        echo 'Nom : '. $result["Nom"] .' Sexe : ' .$result['Sexe']. ' => Poule : ' . $result['Poule'];  
                        // echo '<br> Prenom : '. $result["Prenom"];
                        // echo '<br> Poids : '. $result["Poids"];
                        // echo '<br> Poule : '. $result["Poule"];
                        echo '<br>';
                        
                    }
?>