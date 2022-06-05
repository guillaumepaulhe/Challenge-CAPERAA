<?php
include "base.php";
if ($_GET['file'] != NULL) {
    read_file($_GET['file']);
}

function read_file($file)
{
    global $db;
    $id = array();
    $noms = array();
    $points = array();
    $json = file_get_contents($file);
    $json_data = json_decode($json, true);
    foreach ($json_data as $key => $value) {
        foreach ($value as $key2 => $value2) {
            // echo $key2 . ": " . $value2 . "<br>";
            // echo values that have for keys 'id'
            if ($key2 == 'id') {
                // echo $key2 . " : " .$value2 . "<br>";
                array_push($id, $value2);
            }
            // echo values that have for keys 'nomp'
            if ($key2 == 'nom') {
                // echo $key2 . " : " .$value2 . "<br>";
                array_push($noms, $value2);
            }
            // echo values that have for keys 'points'
            if ($key2 == 'points') {
                // echo $key2 . " : " .$value2 . "<br>";
                array_push($points, $value2);
            }
        }
    }
    try {
        $req_ma_table = $db->prepare("UPDATE participants SET points = points + :points WHERE idParticipant = :id");
        for ($i = 0; $i < count($id); $i++) {
            $req_ma_table->execute(array(
                'points' => $points[$i],
                'id' => $id[$i]
            ));
        }
        // Attends 2 secondes
        sleep(2);
        unlink($file);
        unlink("saves/resultat-poule-" . $file. ".json");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
