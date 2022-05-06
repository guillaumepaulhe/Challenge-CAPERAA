<?php
include "base.php";
include "fonctions.php";
function oui($db,$sexe,$age){
    if($age == 'poussin'){
        $a = 8;
        $b = 9;
    }
    if($age == 'benjamin'){
        $a = 10;
        $b = 11;
    }
    $req_ma_table = $db->prepare("SELECT COUNT(nom) FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $nb = $result['COUNT(nom)'];
            }
            return $nb;
}


echo oui($db,'Homme','poussin');

?>