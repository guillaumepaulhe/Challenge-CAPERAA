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
</div>

<div class="cases">

<div class="case-1">
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1'),total('totala1','totalranda1','totalrandtecha1')">
<input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1'),total('totala1','totalranda1','totalrandtecha1')">
<input type="number" class="grid-btn" name="totala1" id="totala1" disabled>
<input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2'),total('totala2','totalranda2','totalrandtecha2')">  
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2'),total('totala2','totalranda2','totalrandtecha2')"> 
<input type="number" name="totala2" id="totala2" class="grid-btn" min=0 max=10 disabled> 
<input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3'),total('totalb3','totalrandb3','totalrandtechb3')"> 
<input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3'),total('totalb3','totalrandb3','totalrandtechb3')"> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="totalb3" id="totalb3" class="grid-btn" disabled> 
</div>

<div class="case-2">
<input class="grid-btn" id="noir" disabled > 
<input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda1','totalranda1'),total('totala1','totalranda1','totalrandtecha1')"> 
<input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda1','totalranda1'),total('totala1','totalranda1','totalrandtecha1')"> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda2','totalranda2'),total('totala2','totalranda2','totalrandtecha2')"> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda2','totalranda2'),total('totala2','totalranda2','totalrandtecha2')"> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyrandb3','totalrandb3'),total('totalb3','totalrandb3','totalrandtechb3')"> 
<input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyrandb3','totalrandb3'),total('totalb3','totalrandb3','totalrandtechb3'),classement3('totalrandtecha1','totalrandtecha2','totalrandtechb3')"> 
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
</div>