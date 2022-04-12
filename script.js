function findTotal(a,total){
    var arr = document.getElementsByName(a)
    var tot=0
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value)
    }
    document.getElementById(total).value = tot
}


function total(a,b,total){
    var arr = document.getElementsByName(a)
    var arr2 = document.getElementsByName(b)
    var total1 = 0
    var total2 = 0
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            total1 += parseInt(arr[i].value)
    }
    for(var i=0;i<arr2.length;i++){
        if(parseInt(arr2[i].value))
            total2 += parseInt(arr2[i].value)
    }
    document.getElementById(total).value = total1+total2 
}
function classement(a,b,c){
    var arr = document.getElementsByName(a)
    var arr2 = document.getElementsByName(b)
    var arr3 = document.getElementsByName(c)

    var total1 = 0
    var total2 = 0
    var total3 = 0

    var rank1 = 3
    var rank2 = 3
    var rank3 = 3
    
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            total1 += parseInt(arr[i].value)
    }
    for(var i=0;i<arr2.length;i++){
        if(parseInt(arr2[i].value))
            total2 += parseInt(arr2[i].value)
    }
    for(var i=0;i<arr3.length;i++){
        if(parseInt(arr3[i].value))
            total3 += parseInt(arr3[i].value)
    }


if(total1 !=total2 && total2 != total3){
    if(total1 > total2){
        rank1 --
    }
    else{
        rank2--

    }
    if(total2 > total3){
        rank2--
    }
    else{
        rank3--
    }

    if(total1 > total3){
        rank1 --
    }
    else{
        rank3--
    }

    document.getElementById('ranka1').value = rank1  
    document.getElementById('ranka2').value = rank2
    document.getElementById('rankb3').value = rank3
}

if(total1 == total2 && total2 == total3){
    document.getElementById('ranka1').value = NULL
    document.getElementById('ranka2').value = NULL 
    document.getElementById('rankb3').value = NULL
}

}