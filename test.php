<?php
include "base.php";

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
            $poule = $result['Poule'];
        }
    echo $count;
    if($count == 6){
        $file_handle = fopen('poules/poule'.$i.'.php', 'w');
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
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal(\'qtyrandc6\',\'totalrandc6\'),total(\'totalc6\',\'totalrandc6\',\'totalrandtechc6\'),classement6(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\',\'totalrandtechc5\',\'totalrandtechc6\')"></input>
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
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
        <p>Randoris compétition : 1/3 1/2 2/3</p>
        </div>');
    }
    if($count == 5){
        $file_handle = fopen('poules/poule'.$i.'.php', 'w');
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
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal(\'qtyrandc5\',\'totalrandc5\'),total(\'totalc5\',\'totalrandc5\',\'totalrandtechc5\'),classement5(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\',\'totalrandtechc5\')"></input>
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
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
        <p>Randoris compétition : 1/3 1/2 2/3</p>
        </div>
        ');
    }
    if($count == 4){
        $file_handle = fopen('poules/poule'.$i.'.php', 'w');
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
        <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal(\'qtyrandb4\',\'totalrandb4\'),total(\'totalb4\',\'totalrandb4\',\'totalrandtechb4\'),classement4(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\',\'totalrandtechb4\')""> </input>
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
        </div>
        </div>

        <div class="zebi">
        <p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
        <p>Randoris compétition : 1/3 1/2 2/3</p>
        </div>
        ');
    }
    if($count == 3){
        $file_handle = fopen('poules/poule'.$i.'.php', 'w');
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
        <input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal(\'qtyrandb3\',\'totalrandb3\'),total(\'totalb3\',\'totalrandb3\',\'totalrandtechb3\'),classement3(\'totalrandtecha1\',\'totalrandtecha2\',\'totalrandtechb3\')"> 
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
        </div>

        </div>
        <div class="zebi">
            <p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
            <p>Randoris compétition : 1/3 1/2 2/3</p>
        </div>');
    }
        $count = 0;
    }


}

?>
<form class="case" method="post">
    <input type="submit" name="valider"  value="Générer les poules" id="valider" />
</form>

<?php
    if(array_key_exists('valider', $_POST)) {
        create_fiches_poules($db);
    }
?>