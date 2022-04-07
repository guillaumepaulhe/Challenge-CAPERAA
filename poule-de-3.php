<?php  
include "base.php";
include "fonctions.php";
?>

<h1>Poule   n° </h1>
<div class="ta_race">
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
            <p>Guillaume</p>
            <p>Paulhe</p>
            <p>AL CROIX DE NEYRAT</p>
        </div>

        <div class="combatant">
            <p class="text_feuille">A2 :  </p>
            <p>Nom</p>
            <p>Prenom</p>
            <p>Club</p>

        </div>

        <div class="combatant">
            <p class="text_feuille">B3 :  </p>
            <p>Nom</p>
            <p>Prenom</p>
            <p>Club</p>

        </div>  
</div>

<div class="cases">

<div class="case-1">
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1')">
<input type="number" name="qtya1" class="grid-btn" min=0 max=10 onchange="findTotal('qtya1','totala1')">
<input type="number" class="grid-btn" name="oui" id="totala1" onchange="findTotal('oui','totalrandtecha1')"  >
<input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2')">  
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtya2" class="grid-btn" min=0 max=10 onchange="findTotal('qtya2','totala2')"> 
<input type="number" id="totala2" class="grid-btn" min=0 max=10 disabled> 
<input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3')"> 
<input type="number" name="qtyb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyb3','totalb3')"> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" id="totalb3" class="grid-btn" min=0 max=10 disabled> 
</div>

<div class="case-2">
<input class="grid-btn" id="noir" disabled > 
<input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda1','totalranda1')"> 
<input type="number" name="qtyranda1" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda1','totalranda1')"> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda2','totalranda2')"> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtyranda2" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda2','totalranda2')"> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyrandb3','totalrandb3')"> 
<input type="number" name="qtyrandb3" class="grid-btn" min=0 max=10 onchange="findTotal('qtyrandb3','totalrandb3')"> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
</div>

</div>



<div class="case-3">
<input type="number" id="totalranda1" class="grid-btn" min=0 max=10 onchange="findTotal('qtyranda2','totalrandtecha1')" > 
<input type="number" id="totalrandtecha1" class="grid-btn" min=0 max=10 disabled > 
<input type="number" class="grid-btn" min=0 max=10 disabled> 
<input type="number" id="totalranda2" class="grid-btn" min=0 max=10 disabled> 
<input type="number" id="totalrandtecha2" class="grid-btn" min=0 max=10 disabled> 
<input type="number" class="grid-btn" min=0 max=10 disabled> 
<input type="number" id="totalrandb3" class="grid-btn" min=0 max=10 disabled> 
<input type="number" id="totalrandtechb3" class="grid-btn" min=0 max=10 disabled> 
<input type="number" class="grid-btn" min=0 max=10 disabled> 
</div>

</div>
<div class="zebi">
<p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
<p>Randoris compétition : 1/3 1/2 2/3</p>
</div>


<script type="text/javascript">
    function findTotal(a,total){
        // var qty = 'qty'+test;
        // var total = 'total' +test;
        // console.log(qty)
        // console.log(total)

        var arr = document.getElementsByName(a);
        var tot=0;
        for(var i=0;i<arr.length;i++){
            if(parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        document.getElementById(total).value = tot;
        
    }



</script>