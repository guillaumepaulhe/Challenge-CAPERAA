<!-- Feuille de Jury pour Poule de 3 -->
<?php  
include "base.php";
?>

<h1>Poule   n° </h1>
<div class="cc">
<p>Nom : </p>
<p>Prénom : </p>
<p>Club : </p>
</div>
<div class="entete">
    <div class="bb">
        <p>Compétiteurs appelés</p>
        <p>Récompences distribuées</p>
        <p>Fiche saisie</p>
    </div>
<div class="aa">
    <input type="checkbox" class="grid-btn"></input>
    <input type="checkbox" class="grid-btn"></input>
    <input type="checkbox" class="grid-btn"></input>
</div>
</div>

<div class="grid-container">
<div class="grid-text"> 
<p class="text_feuille">A1 :  </p>
<p class="text_feuille">A2 :  </p>
<p class="text_feuille">B3 :  </p>
</div>

<div class="cases">

<div class="case-1">
<input class="grid-btn" id="noir" disabled></input>
<input type="number" name="qty" class="grid-btn" min=0 max=10 onblur="findTotal()"></input>
<input type="number" name="qty" class="grid-btn" min=0 max=10 onblur="findTotal()"></input>
<input type="number" name="total" id="total" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input class="grid-btn"id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10></input>
</div>

<div class="case-2">
<input class="grid-btn" id="noir" disabled ></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10 ></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
<input class="grid-btn" id="noir" disabled></input>
</div>

<div class="case-3">
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
<input type="number" class="grid-btn" min=0 max=10></input>
</div>
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