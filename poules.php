<?php
include 'base.php';
include 'fonctions.php';
if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Jury" )) {
    header("location: login.php");
  }
poules($db);
$poules =1;

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


function create_poule($db,$nb6,$nb5,$nb4,$nb3,$sexe,$age){
    $offset = 0;
    if($age == 'poussin'){
        $a = 8;
        $b = 9;
        $c = 'poussin';
        
    }
    if($age == 'benjamin'){
        $a = 10;
        $b = 11;
        $c = 'benjamin';
    }
    global $poules;
        for($i=1;$i<=$nb6;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,6" );
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
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,5" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND age BETWEEN $a AND $b");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=5; 
            echo '<br>';
        }
        for($i=1;$i<=$nb4;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,4" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND age BETWEEN $a AND $b");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=4; 
            echo '<br>';
        }
        for($i=1;$i<=$nb3;$i++){
            $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Sexe = '$sexe' AND age BETWEEN $a AND $b ORDER BY Poids DESC LIMIT $offset,3" );
            $req_ma_table->execute();
            $result_req_ma_table = $req_ma_table->fetchAll();
            foreach ($result_req_ma_table as $result) {
                $id = $result['idParticipant'];
                $req_ma_table = $db->prepare("UPDATE participants SET Poule = '$poules' WHERE idParticipant = '$id' AND age BETWEEN $a AND $b");
                $req_ma_table->execute();   
                echo 'Nom : '. $result["Nom"] . ' => Poule : ' . $result['Poule'];  
                echo '<br>';
            }
            $poules++;
            $offset+=3; 
            echo '<br>';
        }
}

function create_fiches_poules($db){
    $count = 0;
    $noms[5];
    $prenoms[5];
    $clubs[5];
    $req_ma_table = $db->prepare("SELECT MAX(Poule) FROM participants");
    $req_ma_table->execute();
    $result_req_ma_table = $req_ma_table->fetchAll();
    foreach ($result_req_ma_table as $result) {
        $max_poule = $result['MAX(Poule)'];
    }
    for($i=1;$i<=$max_poule;$i++){
        $req_ma_table = $db->prepare("SELECT * FROM participants WHERE Poule = $i");
        $req_ma_table->execute();
        $result_req_ma_table = $req_ma_table->fetchAll();
        foreach ($result_req_ma_table as $result) {
            $count++;
            $noms[$count] = $result['Nom'];
            $prenoms[$count] = $result['Prenom'];
            $clubs[$count] = $result['Nom_club'];
            $id[$count] = $result['idParticipant'];
            $poule = $result['Poule'];
            $sexe = $result['Sexe'];
            $agee = $result['Age']; 
        }
        if($agee == 8 || $agee == 9){
            $age = 'poussin';
        }
        if($agee == 10 || $agee == 11){
            $age = 'benjamin';
        }
    echo $count;
    if($count == 6){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $id = '.var_export($id, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>
        <h1>Poule   n° <?php echo $poule?></h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>
        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">

        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total" class="score_combat">Total technique</p>
        </div>


        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
        <div class="combatant">
            <p class="text_feuille">A1 :  </p>
            <p><?php
            echo $prenoms[1];
            ?>
            </p>
            <p><?php
            echo $noms[1];
            ?>
            </p>
            <p><?php
            echo $clubs[1];
            ?>
            </p>
        </div>

        <div class="combatant">
            <p class="text_feuille">A2 :  </p>
            <p><?php
            echo $prenoms[2];
            ?>
            </p>
            <p><?php
            echo $noms[2];
            ?>
            </p>
            <p><?php
            echo $clubs[2];
            ?>
            </p>

        </div>

        <div class="combatant">
            <p class="text_feuille">B3 :  </p>
            <p><?php
            echo $prenoms[3];
            ?>
            </p>
            <p><?php
            echo $noms[3];
            ?>
            </p>
            <p><?php
            echo $clubs[3];
            ?>
            </p>
        </div>  


        <div class="combatant">
            <p class="text_feuille">B4 :  </p>
            <p><?php
            echo $prenoms[4];
            ?>
            </p>
            <p><?php
            echo $noms[4];
            ?>
            </p>
            <p><?php
            echo $clubs[4];
            ?>
            </p>
        </div>  

        <div class="combatant">
            <p class="text_feuille">C5 :  </p>
            <p><?php
            echo $prenoms[5];
            ?>
            </p>
            <p><?php
            echo $noms[5];
            ?>
            </p>
            <p><?php
            echo $clubs[5];
            ?>
            </p>
        </div>  

        <div class="combatant">
            <p class="text_feuille">C6 :  </p>
            <p><?php
            echo $prenoms[6];
            ?>
            </p>
            <p><?php
            echo $noms[6];
            ?>
            </p>
            <p><?php
            echo $clubs[6];
            ?>
            </p>
        </div> 
        </div>

        <div class="cases">

        <div class="case-1">
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1"></input>
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2"></input>
        <input type="number" name="qtyb3"  class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3"> </input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input disabled class="grid-btn" id="noir"></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4"></input>
        <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input disabled class="grid-btn" id="noir" ></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc5" id="totalc5"></input>
        <input type="number" name="qtyc6" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc6\',\'totalc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\')"></input>
        <input type="number" name="qtyc6" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc6\',\'totalc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\')"></input>
        <input disabled class="grid-btn" id="noir" ></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc6" id="totalc6"></input>
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal(\'qtyrandc6\',\'totalrandc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal(\'qtyrandc6\',\'totalrandc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\'),classement6(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\',\'totalrandtechc5\',\'totalrandtechc6\'),coockies_points6(),show_confirm()"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        </div>

        </div>
        <div class="case-3">
        <input disabled type="number" class="grid-btn" name="totalranda1" id="totalranda1"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha1" id="totalrandtecha1"></input>
        <input disabled type="number" class="grid-btn" name="ranka1" id="ranka1"></input>
        <input disabled type="number" class="grid-btn" name="totalranda2" id="totalranda2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha2" id="totalrandtecha2"></input>
        <input disabled type="number" class="grid-btn" name="ranka2" id="ranka2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb3" id="totalrandb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb3" id="totalrandtechb3"></input>
        <input disabled type="number" class="grid-btn" name="rankb3" id="rankb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb4" id="totalrandb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb4" id="totalrandtechb4"></input>
        <input disabled type="number" class="grid-btn" name="rankb4" id="rankb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandc5" id="totalrandc5"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechc5" id="totalrandtechc5"></input>
        <input disabled type="number" class="grid-btn" name="rankc5" id="rankc5"></input>
        <input disabled type="number" class="grid-btn" name="totalrandc6" id="totalrandc6"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechc6" id="totalrandtechc6"></input>
        <input disabled type="number" class="grid-btn" name="rankc6" id="rankc6"></input>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form>
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A/B B/C A/C</p>
        <p>Randoris compétition : 1/3 2/6 1/5 4/6 3/5 2/4</p>
        </div>
        
        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\'],
            4 => $_COOKIE[\'pointsb4\'],
            5 => $_COOKIE[\'pointsc5\'],
            6 => $_COOKIE[\'pointsc6\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=6;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }

?>
        
        ');
    }
    if($count == 5){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>
        <h1>Poule   n° <?php echo $poule?></h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>

        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">
        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total" class="score_combat">Total technique</p>
        </div>

        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
        <div class="combatant">
            <p class="text_feuille">A1 :  </p>
            <p><?php
            echo $prenoms[1];
            ?>
            </p>
            <p><?php
            echo $noms[1];
            ?>
            </p>
            <p><?php
            echo $clubs[1];
            ?>
            </p>
        </div>

        <div class="combatant">
            <p class="text_feuille">A2 :  </p>
            <p><?php
            echo $prenoms[2];
            ?>
            </p>
            <p><?php
            echo $noms[2];
            ?>
            </p>
            <p><?php
            echo $clubs[2];
            ?>
            </p>

        </div>

        <div class="combatant">
            <p class="text_feuille">B3 :  </p>
            <p><?php
            echo $prenoms[3];
            ?>
            </p>
            <p><?php
            echo $noms[3];
            ?>
            </p>
            <p><?php
            echo $clubs[3];
            ?>
            </p>
        </div>  


        <div class="combatant">
            <p class="text_feuille">B4 :  </p>
            <p><?php
            echo $prenoms[4];
            ?>
            </p>
            <p><?php
            echo $noms[4];
            ?>
            </p>
            <p><?php
            echo $clubs[4];
            ?>
            </p>
        </div>  

        <div class="combatant">
            <p class="text_feuille">C5 :  </p>
            <p><?php
            echo $prenoms[5];
            ?>
            </p>
            <p><?php
            echo $noms[5];
            ?>
            </p>
            <p><?php
            echo $clubs[5];
            ?>
            </p>
        </div>  
        </div>

        <div class="cases">

        <div class="case-1">
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number"  name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number"  name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2"></input>
        <input type="number"  name="qtyb3" class="grid-btn" min=0 max=10  onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number"  name="qtyb3" class="grid-btn" min=0 max=10  onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3" ></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4"></input>
        <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyc5\',\'totalc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc5" id="totalc5"></input>
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')" ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')" ></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\'),classement5(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\',\'totalrandtechc5\'),coockies_points5(),show_confirm()"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        </div>

        </div>
        <div class="case-3">
        <input disabled type="number" class="grid-btn" name="totalranda1" id="totalranda1"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha1" id="totalrandtecha1"></input>
        <input disabled type="number" class="grid-btn" name="ranka1" id="ranka1"></input>
        <input disabled type="number" class="grid-btn" name="totalranda2" id="totalranda2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha2" id="totalrandtecha2"></input>
        <input disabled type="number" class="grid-btn" name="ranka2" id="ranka2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb3" id="totalrandb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb3" id="totalrandtechb3"></input>
        <input disabled type="number" class="grid-btn" name="rankb3" id="rankb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb4" id="totalrandb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb4" id="totalrandtechb4"></input>
        <input disabled type="number" class="grid-btn" name="rankb4" id="rankb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandc5" id="totalrandc5"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechc5" id="totalrandtechc5"></input>
        <input disabled type="number" class="grid-btn" name="rankc5" id="rankc5"></input>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form>
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A/B A1C5/A2B5 B3/C5</p>
        <p>Randoris compétition : 1/3 1/5 4/5 2/4 2/3</p>
        </div>

        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\'],
            4 => $_COOKIE[\'pointsb4\'],
            5 => $_COOKIE[\'pointsc5\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=5;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }

?>
        
        ');
    }
    if($count == 4){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>
        <h1>Poule   n° <?php echo $poule?></h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>
        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">
        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total" class="score_combat">Total technique</p>
        </div>

        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
        <div class="combatant">
            <p class="text_feuille">A1 :  </p>
            <p><?php
            echo $prenoms[1];
            ?>
            </p>
            <p><?php
            echo $noms[1];
            ?>
            </p>
            <p><?php
            echo $clubs[1];
            ?>
            </p>
        </div>

        <div class="combatant">
            <p class="text_feuille">A2 :  </p>
            <p><?php
            echo $prenoms[2];
            ?>
            </p>
            <p><?php
            echo $noms[2];
            ?>
            </p>
            <p><?php
            echo $clubs[2];
            ?>
            </p>

        </div>

        <div class="combatant">
            <p class="text_feuille">B3 :  </p>
            <p><?php
            echo $prenoms[3];
            ?>
            </p>
            <p><?php
            echo $noms[3];
            ?>
            </p>
            <p><?php
            echo $clubs[3];
            ?>
            </p>
        </div>  


        <div class="combatant">
            <p class="text_feuille">B4 :  </p>
            <p><?php
            echo $prenoms[4];
            ?>
            </p>
            <p><?php
            echo $noms[4];
            ?>
            </p>
            <p><?php
            echo $clubs[4];
            ?>
            </p>
        </div>  

        </div>

        <div class="cases">

        <div class="case-1">
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2" disabled></input>
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3" disabled ></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb4\',\'totalb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4" disabled></input>
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled ></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\')"></input>
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\'),classement4(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\'),coockies_points4(),show_confirm()"> </input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        <input class="grid-btn" id="noir" disabled></input>
        </div>

        </div>
        <div class="case-3">
        <input disabled type="number" class="grid-btn" name="totalranda1" id="totalranda1"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha1" id="totalrandtecha1"></input>
        <input disabled type="number" class="grid-btn" name="ranka1" id="ranka1"></input>
        <input disabled type="number" class="grid-btn" name="totalranda2" id="totalranda2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtecha2" id="totalrandtecha2"></input>
        <input disabled type="number" class="grid-btn" name="ranka2" id="ranka2"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb3" id="totalrandb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb3" id="totalrandtechb3"></input>
        <input disabled type="number" class="grid-btn" name="rankb3" id="rankb3"></input>
        <input disabled type="number" class="grid-btn" name="totalrandb4" id="totalrandb4"></input>
        <input disabled type="number" class="grid-btn" name="totalrandtechb4" id="totalrandtechb4"></input>
        <input disabled type="number" class="grid-btn" name="rankb4" id="rankb4"></input>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form>
        
        </div>
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A/B A1B3/A2B4</p>
        <p>Randoris compétition : 1/3 1/4 2/4 2/3</p>
        </div>
        
        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\'],
            4 => $_COOKIE[\'pointsb4\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=4;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }

?>
        ');
    }
    if($count == 3){
        $file_handle = fopen('poules/poule'.$i.'-'.$sexe.'-'.$age.'.php', 'w');
        // $file_handle = fopen('poules/poule'.$i.'.php', 'w');
        fwrite($file_handle,'<?php
        $noms = '.var_export($noms, true).';
        $prenoms = '.var_export($prenoms, true).';
        $clubs = '.var_export($clubs, true).';
        $poule = '.$poule.';
        include "base.php";
        ?>

        <h1>Poule   n° <?php echo $poule?></h1>
        <div class="duree">
        <p>Durée d\'un Randori technique: 1 minute</p>
        <p>Durée d\'un Randoricompétition: 1 minute30secondes</p>
        </div>
        <div class="entete">
            <div class="bb">
                <p>Compétiteurs appelés</p>
                <p>Récompences distribuées</p>
                <p>Fiche saisie</p>
            </div>
        <div class="aa">
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
            <input type="checkbox" class="grid-btn"> 
        </div>
        </div>

        <div class="grid-container">

        <div class="infos_combat">
        <p></p>
        <p>Nom</p>
        <p>Prénom</p>
        <p>Club</p>
        </div>

        <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total_score" class="score_combat">Total technique</p></div>


        <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
        </div>
            
        <div class="grid-text"> 
                <div class="combatant">
                    <p class="text_feuille">A1 :  </p>
                    <p><?php
                    echo $prenoms[1];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[1];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[1];
                    ?>
                    </p>
                </div>

                <div class="combatant">
                    <p class="text_feuille">A2 :  </p>
                    <p><?php
                    echo $prenoms[2];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[2];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[2];
                    ?>
                    </p>

                </div>

                <div class="combatant">
                    <p class="text_feuille">B3 :  </p>
                    <p><?php
                    echo $prenoms[3];
                    ?>
                    </p>
                    <p><?php
                    echo $noms[3];
                    ?>
                    </p>
                    <p><?php
                    echo $clubs[3];
                    ?>
                    </p>

                </div>  
        </div>

        <div class="cases">

        <div class="case-1">
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')">
        <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya1\',\'totala1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')">
        <input type="number" class="grid-btn" name="totala1" id="totala1" disabled>
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')">  
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtya2\',\'totala2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"> 
        <input type="number" name="totala2" id="totala2" class="grid-btn" min=0 max=10 disabled> 
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"> 
        <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyb3\',\'totalb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="totalb3" id="totalb3" class="grid-btn" disabled> 
        </div>

        <div class="case-2">
        <input class="grid-btn" id="noir" disabled > 
        <input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"> 
        <input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda1\',\'totalranda1\'),total(\'totala1\',\'totalranda1\',\'totalrandtecha1\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyranda2\',\'totalranda2\'),total(\'totala2\',\'totalranda2\',\'totalrandtecha2\')"> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\')"> 
        <input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\'),classement3(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\'),coockies_points3(),show_confirm()"> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled> 
        <input class="grid-btn" id="noir" disabled>     
        <input class="grid-btn" id="noir" disabled> 
        </div>

        </div>


        <div class="case-3">
        <input type="number" name="totalranda1" id="totalranda1" class="grid-btn" disabled > 
        <input type="number" name="totalrandtecha1" id="totalrandtecha1" class="grid-btn" disabled > 
        <input type="number" name="ranka1" id="ranka1" class="grid-btn" disabled> 
        <input type="number" name="totalranda2" id="totalranda2" class="grid-btn" disabled> 
        <input type="number" name="totalrandtecha2" id="totalrandtecha2" class="grid-btn"  disabled> 
        <input type="number" name="ranka2" id="ranka2" class="grid-btn"  disabled> 
        <input type="number" name="totalrandb3" id="totalrandb3" class="grid-btn"  disabled> 
        <input type="number" name="totalrandtechb3" id="totalrandtechb3" class="grid-btn"  disabled> 
        <input type="number" name="rankb3" id="rankb3" class="grid-btn"  disabled>
        <p></p>
        <form action="" class="vfiche"  method="post">
        <input type="submit" value="Valider la fiche" name="testt" id="testt"  class="vfiche">
        </form> 
        </div>

        </div>
        <div class="zebi">
            <p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
            <p>Randoris compétition : 1/3 1/2 2/3</p>
        </div>
        
        <?php

        $points = array (
            1 => $_COOKIE[\'pointsa1\'],
            2 => $_COOKIE[\'pointsa2\'],
            3 => $_COOKIE[\'pointsb3\']
          );
       
          function testt($db){
            global $points;
            global $id;
            for($i=1;$i<=3;$i++){
                $a = $points[$i];
                $b = $id[$i];
                $req_ma_table = $db->prepare("UPDATE participants SET points = points + $a WHERE idParticipant = $b");
                $req_ma_table->execute();
                $result_req_ma_table = $req_ma_table->fetchAll();
            }
        }
        if(array_key_exists(\'testt\',$_POST)){
                testt($db);
        }

?>');
    }
        $count = 0;
    }
}
function reset_poules($db){
  $req_ma_table = $db->prepare("UPDATE participants SET Poule = NULL");
  $req_ma_table->execute();
  $result_req_ma_table = $req_ma_table->fetchAll();
}
?>
<form class="case" method="post">
    <input type="submit" name="generate"  value="Générer les poules" id="generate" />
    <input type="submit" name="fiches"  value="Créer les fiches de poules" id="fiches" />
    <input type="submit" name="reset"  value="Réinitialiser les poules" id="reset" />
</form>
<?php
    if(array_key_exists('fiches', $_POST)) {
        create_fiches_poules($db);
    }
    if(array_key_exists('generate', $_POST)) {
        echo 'Homme : <br>';
        $nb_participants_homme = get_nb_participants($db,'Homme');
        $nb_participants_homme_poussin = oui($db,'Homme','poussin');
        $nb_participants_homme_benjamin = oui($db,'Homme','benjamin');

        $reste_homme_poussin = $nb_participants_homme_poussin % 6;
        $reste_homme_benjamin = $nb_participants_homme_benjamin % 6;

        // echo 'nombre participants Homme : ' . $nb_participants_homme . '<br>';
        echo 'nombre participants Homme poussin : ' . $nb_participants_homme_poussin . '<br>';
        echo 'nombre participants Homme benjamin : ' . $nb_participants_homme_benjamin . '<br>';
        echo '<br>';
        if($reste_homme_poussin == 0){
            echo 'nombre de poules de 6 Homme poussin : ' . $nb_participants_homme_poussin / 6;
            echo '<br>';
            // create_poule($db,($nb_participants_homme/6),0,0,0,'Homme');
            create_poule($db,($nb_participants_homme_poussin/6),0,0,0,'Homme','poussin');
        }
        else{
            if($reste_homme_poussin >= 3){
                $nb_poule_de_6_p = ($nb_participants_homme_poussin - $reste_homme_poussin) /6;
                if(0 > $nb_poule_de_6_p) $nb_poule_de_6_p = 0;
                echo 'nombre de poules de 6 Homme poussin : ' . $nb_poule_de_6_p. ' reste : ' . $reste_homme_poussin;
                echo ' <br> 1 Poule de ' . $reste_homme_poussin . 'Homme poussin';
                echo '<br>';
                echo '<br>';
                if($reste_homme_poussin == 3) $nb_poule_de_3_p = 1;
                if($reste_homme_poussin == 4) $nb_poule_de_4_p = 1;
                if($reste_homme_poussin == 5) $nb_poule_de_5_p = 1;
            }
            if($reste_homme_poussin == 1){
                    echo '<br> reste  : ' . ($reste_homme_poussin + 6) . ' participants Homme';
                echo '<br> Poule de 4 Homme : 1 <br> Poule de 3 Homme : 1 <br> <br>';
                $nb_poule_de_6_p = (($nb_participants_homme_poussin - $reste_homme_poussin) /6 -1);
                $nb_poule_de_5_p = 0;
                $nb_poule_de_4_p = 1;
                $nb_poule_de_3_p = 1;
            }
            if($reste_homme_poussin == 2){
                echo '<br> nombre de poules de 6 Homme  : ' . (($nb_participants_homme - $reste_homme_poussin) /6 -1);
                echo '<br> reste  : ' . ($reste_homme_poussin + 6) . ' participants Homme ';
                echo '<br> Poule de 4 Homme : 2';
                $nb_poule_de_6_p = (($nb_participants_homme_poussin - $reste_homme_poussin) /6 -1);
                $nb_poule_de_5_p = 0;
                $nb_poule_de_4_p = 2;
                $nb_poule_de_3_p = 0;
            }
        
            create_poule($db,$nb_poule_de_6_p,$nb_poule_de_5_p,$nb_poule_de_4_p,$nb_poule_de_3_p,'Homme','poussin');
        
        }
        if($reste_homme_benjamin == 0){
            echo 'nombre de poules de 6 Homme benjamin : ' . $nb_participants_homme_benjamin / 6;
            echo '<br>';
            // create_boule($db,($nb_barticipants_homme/6),0,0,0,'Homme');
            create_poule($db,($nb_participants_homme_benjamin/6),0,0,0,'Homme','benjamin');
        }
        else{
            if($reste_homme_benjamin >= 3){
                echo 'nombre de poules de 6 Homme benjamin: ' . ($nb_participants_homme_benjamin - $reste_homme_benjamin) /6 . ' reste : ' . $reste_homme_benjamin;
                echo ' <br> 1 Poule de ' . $reste_homme_benjamin . 'Homme';
                echo '<br>';
                echo '<br>';
                $nb_boule_de_6_b = ($nb_participants_homme_benjamin - $reste_homme_benjamin) /6;
                if($reste_homme_benjamin == 3) $nb_boule_de_3_b = 1;
                if($reste_homme_benjamin == 4) $nb_boule_de_4_b = 1;
                if($reste_homme_benjamin == 5) $nb_boule_de_5_b = 1;
            }
            if($reste_homme_benjamin == 1){
                echo '<br> nombre de poules de 6 Homme benjamin : ' . (($nb_participants_homme_benjamin - $reste_homme_benjamin) /6 -1);
                echo '<br> reste  : ' . ($reste_homme_benjamin + 6) . ' participants Homme';
                echo '<br> Poule de 4 Homme : 1 <br> Poule de 3 Homme : 1 <br> <br>';
                $nb_boule_de_6_b = (($nb_participants_homme_benjamin - $reste_homme_benjamin) /6 -1);
                $nb_boule_de_5_b = 0;
                $nb_boule_de_4_b = 1;
                $nb_boule_de_3_b = 1;
            }
            if($reste_homme_benjamin == 2){
                echo '<br> nombre de poules de 6 Homme benjamin  : ' . (($nb_participants_homme_benjamin - $reste_homme_benjamin) /6 -1);
                echo '<br> reste  : ' . ($reste_homme_benjamin + 6) . ' participants Homme ';
                echo '<br> Poule de 4 Homme : 2';
                $nb_boule_de_6_b = (($nb_participants_homme_benjamin - $reste_homme_benjamin) /6 -1);
                $nb_boule_de_5_b = 0;
                $nb_boule_de_4_b = 2;
                $nb_boule_de_3_b = 0;
            }
        
            create_poule($db,$nb_boule_de_6_b,$nb_boule_de_5_b,$nb_boule_de_4_b,$nb_boule_de_3_b,'Homme','benjamin');
        
        }
        // ---------------------------femme---------------------------
        echo 'femme : <br>';
        $nb_participants_femme = get_nb_participants($db,'femme');
        $nb_participants_femme_poussin = oui($db,'femme','poussin');
        $nb_participants_femme_benjamin = oui($db,'femme','benjamin');

        $reste_femme_poussin = $nb_participants_femme_poussin % 6;
        $reste_femme_benjamin = $nb_participants_femme_benjamin % 6;

        // echo 'nombre participants femme : ' . $nb_participants_femme . '<br>';
        echo 'nombre participants femme poussin : ' . $nb_participants_femme_poussin . '<br>';
        echo 'nombre participants femme benjamin : ' . $nb_participants_femme_benjamin . '<br>';
        echo '<br>';
        if($reste_femme_poussin == 0){
            echo 'nombre de poules de 6 femme poussin : ' . $nb_participants_femme_poussin / 6;
            echo '<br>';
            // create_poule($db,($nb_participants_femme/6),0,0,0,'femme');
            create_poule($db,($nb_participants_femme_poussin/6),0,0,0,'femme','poussin');
        }
        else{
            if($reste_femme_poussin >= 3){
                $nb_poule_de_6_p = ($nb_participants_femme_poussin - $reste_femme_poussin) /6;
                if(0 > $nb_poule_de_6_p) $nb_poule_de_6_p = 0;
                echo 'nombre de poules de 6 femme poussin : ' . $nb_poule_de_6_p. ' reste : ' . $reste_femme_poussin;
                echo ' <br> 1 Poule de ' . $reste_femme_poussin . 'femme poussin';
                echo '<br>';
                echo '<br>';
                if($reste_femme_poussin == 3) $nb_poule_de_3_p = 1;
                if($reste_femme_poussin == 4) $nb_poule_de_4_p = 1;
                if($reste_femme_poussin == 5) $nb_poule_de_5_p = 1;
            }
            if($reste_femme_poussin == 1){
                    echo '<br> reste  : ' . ($reste_femme_poussin + 6) . ' participants femme';
                echo '<br> Poule de 4 femme : 1 <br> Poule de 3 femme : 1 <br> <br>';
                $nb_poule_de_6_p = (($nb_participants_femme_poussin - $reste_femme_poussin) /6 -1);
                $nb_poule_de_5_p = 0;
                $nb_poule_de_4_p = 1;
                $nb_poule_de_3_p = 1;
            }
            if($reste_femme_poussin == 2){
                echo '<br> nombre de poules de 6 femme  : ' . (($nb_participants_femme - $reste_femme_poussin) /6 -1);
                echo '<br> reste  : ' . ($reste_femme_poussin + 6) . ' participants femme ';
                echo '<br> Poule de 4 femme : 2';
                $nb_poule_de_6_p = (($nb_participants_femme_poussin - $reste_femme_poussin) /6 -1);
                $nb_poule_de_5_p = 0;
                $nb_poule_de_4_p = 2;
                $nb_poule_de_3_p = 0;
            }
        
            create_poule($db,$nb_poule_de_6_p,$nb_poule_de_5_p,$nb_poule_de_4_p,$nb_poule_de_3_p,'femme','poussin');
        
        }
        if($reste_femme_benjamin == 0){
            echo 'nombre de poules de 6 femme benjamin : ' . $nb_participants_femme_benjamin / 6;
            echo '<br>';
            // create_boule($db,($nb_barticipants_femme/6),0,0,0,'femme');
            create_poule($db,($nb_participants_femme_benjamin/6),0,0,0,'femme','benjamin');
        }
        else{
            if($reste_femme_benjamin >= 3){
                echo 'nombre de poules de 6 femme benjamin: ' . ($nb_participants_femme_benjamin - $reste_femme_benjamin) /6 . ' reste : ' . $reste_femme_benjamin;
                echo ' <br> 1 Poule de ' . $reste_femme_benjamin . 'femme';
                echo '<br>';
                echo '<br>';
                $nb_boule_de_6_b = ($nb_participants_femme_benjamin - $reste_femme_benjamin) /6;
                if($reste_femme_benjamin == 3) $nb_boule_de_3_b = 1;
                if($reste_femme_benjamin == 4) $nb_boule_de_4_b = 1;
                if($reste_femme_benjamin == 5) $nb_boule_de_5_b = 1;
            }
            if($reste_femme_benjamin == 1){
                echo '<br> nombre de poules de 6 femme benjamin : ' . (($nb_participants_femme_benjamin - $reste_femme_benjamin) /6 -1);
                echo '<br> reste  : ' . ($reste_femme_benjamin + 6) . ' participants femme';
                echo '<br> Poule de 4 femme : 1 <br> Poule de 3 femme : 1 <br> <br>';
                $nb_boule_de_6_b = (($nb_participants_femme_benjamin - $reste_femme_benjamin) /6 -1);
                $nb_boule_de_5_b = 0;
                $nb_boule_de_4_b = 1;
                $nb_boule_de_3_b = 1;
            }
            if($reste_femme_benjamin == 2){
                echo '<br> nombre de poules de 6 femme benjamin  : ' . (($nb_participants_femme_benjamin - $reste_femme_benjamin) /6 -1);
                echo '<br> reste  : ' . ($reste_femme_benjamin + 6) . ' participants femme ';
                echo '<br> Poule de 4 femme : 2';
                $nb_boule_de_6_b = (($nb_participants_femme_benjamin - $reste_femme_benjamin) /6 -1);
                $nb_boule_de_5_b = 0;
                $nb_boule_de_4_b = 2;
                $nb_boule_de_3_b = 0;
            }
        
            create_poule($db,$nb_boule_de_6_b,$nb_boule_de_5_b,$nb_boule_de_4_b,$nb_boule_de_3_b,'femme','benjamin');
        
        }
    }
    if(array_key_exists('reset', $_POST)){
        reset_poules($db);
    }
?>