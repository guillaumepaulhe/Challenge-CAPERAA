<?php
function fail()
{
    global $poule;
    global $noms;
    global $prenoms;
    global $clubs;
    global $id;
    global $points;
    $array = array(["Poule" => $poule]);
    foreach ($noms as $i => $value) {
        if ($points[$i] == NULL) {
            $points[$i] = 0;
        }
        array_push($array, ['nom' => $noms[$i], 'prenom' => $prenoms[$i], 'club' => $clubs[$i], 'id' => $id[$i], 'points' => $points[$i]]);
    }
    $json = json_encode($array);
    $file = 'saves/resultat-poule-' . $poule . '.json';
    $file_handle = fopen($file, 'w');
    fwrite($file_handle, $json);
    fclose($file_handle);
    echo '<p> Erreur de connexion à la base de données. Les données ont été enregistrées dans le fichier :  "' . $file . '"</p>';
    echo '<p> Cliquez <a download href="' . $file . '"> ici</a> pour télécharger le fichier</p> ';
    echo '<p> Vous pouvez l\'importer plus tard sur la page suivante <a href="import.php">Importer</a> </p>';
}
$poule = 1;
$noms = array(
    1 => 'Dupont',
    2 => 'Garot',
    3 => 'Michaud',
    4 => 'dgvbxf',
    5 => 'fhdnb',
);
$prenoms = array(
    1 => 'Titouan',
    2 => 'Virgil',
    3 => 'Olivier',
    4 => 'fdxgbbfd',
    5 => 'fgcn',
);
$clubs = array(
    1 => 'JUDO CLUB DES MARTRES DE VEYRE',
    2 => 'AMICALE LAIQUE BEAUMONT JUDO',
    3 => 'CENTRE LOISIRS LE CENDRE',
    4 => 'CENTRE LOISIRS LE CENDRE',
    5 => 'CENTRE LOISIRS LE CENDRE',
);

$id = array(
    1 => '26',
    2 => '27',
    3 => '38',
    4 => '138',
    5 => '139',
);
$points = array(
    1 => $_COOKIE['pointsa1'],
    2 => $_COOKIE['pointsa2'],
    3 => $_COOKIE['pointsb3'],
    4 => $_COOKIE['pointsb4'],
    5 => $_COOKIE['pointsc5']
);
include "base.php";
try {
    $db = new PDO('mysql:host=a;dbname=caperaa;charset=utf8', 'root', 'root', array(
        PDO::ATTR_TIMEOUT => 1, // in seconds
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
} catch (PDOException $e) {
    fail();
    echo '<p style="color: #d93025;"> DEBUG : ';
    die('Erreur : ' . $e->getMessage());
    echo '</p>';
}

function testt($db)
{
    global $points;
    global $id;
    for ($i = 1; $i <= 5; $i++) {
        $a = $points[$i];
        $b = $id[$i];
        $req_ma_table = $db->prepare("SELECT * FROM Participants");
        $req_ma_table->execute();
        $resultat = $req_ma_table->fetchAll();
        foreach ($resultat as $value) {
            echo $value['Nom'];
        }
    }
}
if (array_key_exists('testt', $_POST)) {
    try {
        testt($db);
    } catch (Exception $e) {
        fail();
        echo '<p style="color: #d93025;"> DEBUG : ';
        die('Erreur : ' . $e->getMessage());
        echo '</p>';
    }
}
?>
<h1>Poule n° <?php echo $poule ?> (poussin Homme)</h1>
<div class="duree">
    <p>Durée d'un Randori technique: 1 minute</p>
    <p>Durée d'un Randoricompétition: 1 minute30secondes</p>
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
        <p>Prénom</p>
        <p>Nom</p>
        <p>Club</p>
    </div>

    <div class="score_combat">
        <p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
        <p id="total" class="score_combat">Total technique</p>
        <p id="randori" class="score_combat">Combat RANDORI</p>
    </div>

    <div class="total_combat">
        <p class="total_combat">Total RANDORI</p>
        <p class="total_combat">Total technique + Randori</p>
        <p class="total_combat">Classement</p>
    </div>

    <div class="grid-text">
        <div class="combatant">
            <p class="text_feuille">A1 : </p>
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
            <p class="text_feuille">A2 : </p>
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
            <p class="text_feuille">B3 : </p>
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
            <p class="text_feuille">B4 : </p>
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
            <p class="text_feuille">C5 : </p>
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
            <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1'),total('totala1','totalranda1','totalrandtecha1')"></input>
            <input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1'),total('totala1','totalranda1','totalrandtecha1')"></input>
            <input disabled type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2'),total('totala2','totalranda2','totalrandtecha2')"></input>
            <input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2'),total('totala2','totalranda2','totalrandtecha2')"></input>
            <input disabled type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2"></input>
            <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
            <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3"></input>
            <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb4','totalb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb4','totalb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
            <input disabled type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4"></input>
            <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal('qtyc5','totalc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
            <input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal('qtyc5','totalc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input disabled type="number" class="grid-btn" min=0 max=10 name="totalc5" id="totalc5"></input>
        </div>

        <div class="case-2">
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal('qtyranda1','totalranda1'),total('totala1','totalranda1','totalrandtecha1')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal('qtyranda1','totalranda1'),total('totala1','totalranda1','totalrandtecha1')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal('qtyranda2','totalranda2'),total('totala2','totalranda2','totalrandtecha2')"></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal('qtyranda2','totalranda2'),total('totala2','totalranda2','totalrandtecha2')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal('qtyrandb3','totalrandb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal('qtyrandb3','totalrandb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal('qtyrandb4','totalrandb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal('qtyrandb4','totalrandb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal('qtyrandc5','totalrandc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
            <input class="grid-btn" id="noir" disabled></input>
            <input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal('qtyrandc5','totalrandc5'),total('totalc5','totalrandc5','totalrandtechc5'),classement5('totalrandtecha1','totalrandtecha2','totalrandtechb3','totalrandtechb4','totalrandtechc5'),coockies_points5(),show_confirm()"></input>
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
        <form action="" class="vfiche" method="post">
            <input type="submit" value="Valider la fiche" name="testt" id="testt" class="vfiche">
        </form>
    </div>

    <div class="zebi">
        <p>Randoris Techniques : Couples A/B A1C5/A2B5 B3/C5</p>
        <p>Randoris compétition : 1/3 1/5 4/5 2/4 2/3</p>
    </div>

    <?php




    ?>