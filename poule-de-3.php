<!-- Feuille de Jury pour Poule de 3 -->
<?php  
include "base.php";
?>

<h1>Poule   n° </h1>
<div class="ta_race">
<p>Duréed'un Randori technique: 1 minute</p>
<p>Duréed'un Randoricompétition: 1 minute30secondes</p>
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
<p>Nom</p>
<p>Prénom</p>
<p>Club</p>
</div>

<div class="score_combat">
<p id="exp" class="score_combat"> Expression technique YAKUSOKUGEIKO </p>
<p id="total" class="score_combat">Total technique</p></div>


<div class="total_combat">
<p class="total_combat">Total RANDORI</p>
<p class="total_combat">Total technique + Randori</p>
<p class="total_combat">Classement</p>
</div>
    
<div class="grid-text"> 
<p class="text_feuille">A1 :  </p>
<p class="text_feuille">A2 :  </p>
<p class="text_feuille">B3 :  </p>
</div>

<div class="cases">

<div class="case-1">
<input class="grid-btn" id="noir" disabled> 
<input type="number" name="qty" class="grid-btn" min=0 max=10 onblur="findTotal()">
<input type="number" name="qty" class="grid-btn" min=0 max=10 onblur="findTotal()">
<input type="number" name="total" id="total" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" class="grid-btn" min=0 max=10> 
</div>


<script type="text/javascript">
function findTotal(){
    var arr = document.getElementsByName('qty');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total').value = tot;
}
    </script>

<div class="case-2">
<input class="grid-btn" id="noir" disabled > 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" class="grid-btn" min=0 max=10> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" class="grid-btn" min=0 max=10 > 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
<input class="grid-btn" id="noir" disabled> 
</div>

</div>

<div class="case-3">
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
<input type="number" class="grid-btn" min=0 max=10> 
</div>

</div>
<div class="zebi">
<p>Randoris Techniques : Couples A1A2 A1B3 A2B3</p>
<p>Randoris compétition : 1/3 1/2 2/3</p>
</div>

