<?php  
include "base.php";
?>
<h1>Poule   n° <?php echo $poule?></h1>
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
    echo $prenom1;
    ?>
    </p>
    <p><?php
    echo $nom1;
    ?>
    </p>
    <p><?php
    echo $club1;
    ?>
    </p>
</div>

<div class="combatant">
    <p class="text_feuille">A2 :  </p>
    <p><?php
    echo $prenom2;
    ?>
    </p>
    <p><?php
    echo $nom2;
    ?>
    </p>
    <p><?php
    echo $club2;
    ?>
    </p>

</div>

<div class="combatant">
    <p class="text_feuille">B3 :  </p>
    <p><?php
    echo $prenom3;
    ?>
    </p>
    <p><?php
    echo $nom3;
    ?>
    </p>
    <p><?php
    echo $club3;
    ?>
    </p>
</div>  


<div class="combatant">
    <p class="text_feuille">B4 :  </p>
    <p><?php
    echo $prenom4;
    ?>
    </p>
    <p><?php
    echo $nom4;
    ?>
    </p>
    <p><?php
    echo $club4;
    ?>
    </p>
</div>  

<div class="combatant">
    <p class="text_feuille">C5 :  </p>
    <p><?php
    echo $prenom5;
    ?>
    </p>
    <p><?php
    echo $nom5;
    ?>
    </p>
    <p><?php
    echo $club5;
    ?>
    </p>
</div>  

<div class="combatant">
    <p class="text_feuille">C6 :  </p>
    <p><?php
    echo $prenom6;
    ?>
    </p>
    <p><?php
    echo $nom6;
    ?>
    </p>
    <p><?php
    echo $club6;
    ?>
    </p>
</div> 
</div>

<div class="cases">

<div class="case-1">
<input disabled class="grid-btn" id="noir"></input>
<input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1'),total('totala1','totalranda1','totalrandtecha1')"></input>
<input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1'),total('totala1','totalranda1','totalrandtecha1')"></input>
<input disabled type="number" class="grid-btn" min=0 max=10 name="totala1" id="totala1"></input>
<input disabled class="grid-btn" id="noir"></input>
<input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2'),total('totala2','totalranda2','totalrandtecha2')"></input>
<input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2'),total('totala2','totalranda2','totalrandtecha2')"></input>
<input disabled type="number" class="grid-btn" min=0 max=10 name="totala2" id="totala2"></input>
<input type="number" name="qtyb3"  class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
<input disabled class="grid-btn" id="noir"></input>
<input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
<input disabled type="number" class="grid-btn" min=0 max=10 name="totalb3" id="totalb3"> </input>
<input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb4','totalb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
<input disabled class="grid-btn" id="noir"></input>
<input type="number" name="qtyb4" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb4','totalb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
<input disabled type="number" class="grid-btn" min=0 max=10 name="totalb4" id="totalb4"></input>
<input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal('qtyc5','totalc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
<input type="number" name="qtyc5" class="grid-btn" min=0 max=10 onchange="findTotal('qtyc5','totalc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
<input disabled class="grid-btn" id="noir" ></input>
<input disabled type="number" class="grid-btn" min=0 max=10 name="totalc5" id="totalc5"></input>
<input type="number" name="qtyc6" class="grid-btn" min=0 max=10 onchange="findTotal('qtyc6','totalc6'),total('totalc6','totalrandc6','totalrandtechc6')"></input>
<input type="number" name="qtyc6" class="grid-btn" min=0 max=10 onchange="findTotal('qtyc6','totalc6'),total('totalc6','totalrandc6','totalrandtechc6')"></input>
<input disabled class="grid-btn" id="noir" ></input>
<input disabled type="number" class="grid-btn" min=0 max=10 name="totalc6" id="totalc6"></input>
</div>

<div class="case-2">
<input class="grid-btn" id="noir" disabled ></input>
<input class="grid-btn" id="noir" disabled ></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal('qtyranda1','totalranda1'),total('totala1','totalranda1','totalrandtecha1')"></input>
<input class="grid-btn" id="noir" disabled ></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyranda1" onchange="findTotal('qtyranda1','totalranda1'),total('totala1','totalranda1','totalrandtecha1')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal('qtyranda2','totalranda2'),total('totala2','totalranda2','totalrandtecha2')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyranda2" onchange="findTotal('qtyranda2','totalranda2'),total('totala2','totalranda2','totalrandtecha2')"></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal('qtyrandb3','totalrandb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandb3" onchange="findTotal('qtyrandb3','totalrandb3'),total('totalb3','totalrandb3','totalrandtechb3')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal('qtyrandb4','totalrandb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandb4" onchange="findTotal('qtyrandb4','totalrandb4'),total('totalb4','totalrandb4','totalrandtechb4')"></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal('qtyrandc5','totalrandc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandc5" onchange="findTotal('qtyrandc5','totalrandc5'),total('totalc5','totalrandc5','totalrandtechc5')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal('qtyrandc6','totalrandc6'),total('totalc6','totalrandc6','totalrandtechc6')"></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 name="qtyrandc6" onchange="findTotal('qtyrandc6','totalrandc6'),total('totalc6','totalrandc6','totalrandtechc6'),classement6('totalrandtecha1','totalrandtecha2','totalrandtechb3','totalrandtechb4','totalrandtechc5','totalrandtechc6')"></input>
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
</div>
