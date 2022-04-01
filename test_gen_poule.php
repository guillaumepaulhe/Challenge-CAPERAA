<?php
include "base.php";
include "fonctions.php";
poule($db);

echo get_nb_participants($db);
?>