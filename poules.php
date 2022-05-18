<?php
include 'base.php';
include 'fonctions.php';
if (get_role($db,$_SESSION['email']) != ("Administrateur" || "Jury" )) {
    header("location: login.php");
  }
$poules =1;

    if(array_key_exists('fiches', $_POST)) {
        create_fiches_poules($db);
    }
    if(array_key_exists('generate', $_POST)) { //si on a cliqué sur le bouton
        echo 'Homme : <br>';
        $nb_participants_homme_poussin = get_nb_participants_age($db,'Homme','poussin');
        $nb_participants_homme_benjamin = get_nb_participants_age($db,'Homme','benjamin');

        $reste_homme_poussin = $nb_participants_homme_poussin % 6;
        $reste_homme_benjamin = $nb_participants_homme_benjamin % 6;

        // echo 'nombre participants Homme : ' . $nb_participants_homme . '<br>';
        echo 'nombre participants Homme poussin : ' . $nb_participants_homme_poussin . '<br>';
        echo 'nombre participants Homme benjamin : ' . $nb_participants_homme_benjamin . '<br>';
        echo '<br>';
        if($reste_homme_poussin == 0){ // si le nombre de participants est un multiple de 6
            echo 'nombre de poules de 6 Homme poussin : ' . $nb_participants_homme_poussin / 6;
            echo '<br>';
            // on crée uniquement des poules de 6 car le nombre de participants est un multiple de 6
            create_poule($db,($nb_participants_homme_poussin/6),0,0,0,'Homme','poussin');
        }
        else{
            if($reste_homme_poussin >= 3){ // si il reste plus de 3 participants
                $nb_poule_de_6_p = ($nb_participants_homme_poussin - $reste_homme_poussin) /6;
                if(0 > $nb_poule_de_6_p) $nb_poule_de_6_p = 0;
                echo 'nombre de poules de 6 Homme poussin : ' . $nb_poule_de_6_p. ' reste : ' . $reste_homme_poussin;
                echo ' <br> 1 Poule de ' . $reste_homme_poussin . 'Homme poussin';
                echo '<br>';
                echo '<br>';
                if($reste_homme_poussin == 3) $nb_poule_de_3_p = 1; // si il reste 3 participants -> on crée une poule de 3
                if($reste_homme_poussin == 4) $nb_poule_de_4_p = 1; // si il reste 4 participants -> on crée une poule de 4
                if($reste_homme_poussin == 5) $nb_poule_de_5_p = 1; // si il reste 5 participants -> on crée une poule de 5
            }
            if($reste_homme_poussin == 1){ // si il reste 1 seul participant
                    echo '<br> reste  : ' . ($reste_homme_poussin + 6) . ' participants Homme';
                echo '<br> Poule de 4 Homme : 1 <br> Poule de 3 Homme : 1 <br> <br>';
                $nb_poule_de_6_p = (($nb_participants_homme_poussin - $reste_homme_poussin) /6 -1); 
                $nb_poule_de_5_p = 0; // on crée pas de poule de 5
                $nb_poule_de_4_p = 1; // on crée une poule de 4
                $nb_poule_de_3_p = 1; // on crée une poule de 3
            }
            if($reste_homme_poussin == 2){ // si il reste 2 participant
                echo '<br> nombre de poules de 6 Homme  : ' . (($nb_participants_homme - $reste_homme_poussin) /6 -1);
                echo '<br> reste  : ' . ($reste_homme_poussin + 6) . ' participants Homme ';
                echo '<br> Poule de 4 Homme : 2';
                $nb_poule_de_6_p = (($nb_participants_homme_poussin - $reste_homme_poussin) /6 -1);
                $nb_poule_de_5_p = 0;
                $nb_poule_de_4_p = 2; // on crée 2 poules de 4
                $nb_poule_de_3_p = 0;
            }
            // appel de la fonction de creation des poules
            create_poule($db,$nb_poule_de_6_p,$nb_poule_de_5_p,$nb_poule_de_4_p,$nb_poule_de_3_p,'Homme','poussin'); 
        
        }
        if($reste_homme_benjamin == 0){ // si le nombre de participants est un multiple de 6
            echo 'nombre de poules de 6 Homme benjamin : ' . $nb_participants_homme_benjamin / 6;
            echo '<br>';
            // on crée uniquement des poules de 6 car le nombre de participants benjamins hommes est un multiple de 6
            create_poule($db,($nb_participants_homme_benjamin/6),0,0,0,'Homme','benjamin');
        }
        else{
            if($reste_homme_benjamin >= 3){
                echo 'nombre de poules de 6 Homme benjamin: ' . ($nb_participants_homme_benjamin - $reste_homme_benjamin) /6 . ' reste : ' . $reste_homme_benjamin;
                echo ' <br> 1 Poule de ' . $reste_homme_benjamin . 'Homme';
                echo '<br>';
                echo '<br>';
                $nb_boule_de_6_b = ($nb_participants_homme_benjamin - $reste_homme_benjamin) /6;
                if($reste_homme_benjamin == 3) $nb_boule_de_3_b = 1; // si il reste 3 participants -> on crée une poule de 3
                if($reste_homme_benjamin == 4) $nb_boule_de_4_b = 1; // si il reste 4 participants -> on crée une poule de 4
                if($reste_homme_benjamin == 5) $nb_boule_de_5_b = 1; // si il reste 5 participants -> on crée une poule de 5
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
        $nb_participants_femme_poussin = get_nb_participants_age($db,'femme','poussin');
        $nb_participants_femme_benjamin = get_nb_participants_age($db,'femme','benjamin');

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
    <div class='grid-poules'>
        <div class="btn_poules">
            <form method="post">
                <input class="poules" type="submit" name="generate"  value="Générer les poules" id="generate" />
                <input class="poules" type="submit" name="fiches"  value="Créer les fiches de poules" id="fiches" />
                <input class="poules" type="submit" name="reset"  value="Réinitialiser les poules" id="reset" />
            </form>
        </div>
        <div class="list_poules">
            <?php
            poules($db);
            ?>
        </div>
    </div>