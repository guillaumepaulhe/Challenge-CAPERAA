function findTotal(a, total) {
    var arr = document.getElementsByName(a)
    var tot = 0
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            tot += parseInt(arr[i].value)
    }
    document.getElementById(total).value = tot
}

function total(a, b, total) {
    var arr = document.getElementsByName(a)
    var arr2 = document.getElementsByName(b)
    var total1 = 0
    var total2 = 0
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            total1 += parseInt(arr[i].value)
    }
    for (var i = 0; i < arr2.length; i++) {
        if (parseInt(arr2[i].value))
            total2 += parseInt(arr2[i].value)
    }
    document.getElementById(total).value = total1 + total2
}

function classement6(a, b, c, d, e, f) {
    arr = [document.getElementById(a).value, document.getElementById(b).value, document.getElementById(c).value, document.getElementById(d).value, document.getElementById(e).value, document.getElementById(f).value]
    sorted = arr.slice().sort(function (a, b) { return b - a })
    ranks = arr.map(function (v) { return sorted.indexOf(v) + 1 });
    document.getElementById('ranka1').value = ranks[0]
    document.getElementById('ranka2').value = ranks[1]
    document.getElementById('rankb3').value = ranks[2]
    document.getElementById('rankb4').value = ranks[3]
    document.getElementById('rankc5').value = ranks[4]
    document.getElementById('rankc6').value = ranks[5]
}

function classement5(a, b, c, d, e) {
    arr = [document.getElementById(a).value, document.getElementById(b).value, document.getElementById(c).value, document.getElementById(d).value, document.getElementById(e).value,]
    sorted = arr.slice().sort(function (a, b) { return b - a })
    ranks = arr.map(function (v) { return sorted.indexOf(v) + 1 });
    document.getElementById('ranka1').value = ranks[0]
    document.getElementById('ranka2').value = ranks[1]
    document.getElementById('rankb3').value = ranks[2]
    document.getElementById('rankb4').value = ranks[3]
    document.getElementById('rankc5').value = ranks[4]
}

function classement4(a, b, c, d) {
    arr = [document.getElementById(a).value, document.getElementById(b).value, document.getElementById(c).value, document.getElementById(d).value]
    sorted = arr.slice().sort(function (a, b) { return b - a })
    ranks = arr.map(function (v) { return sorted.indexOf(v) + 1 });
    document.getElementById('ranka1').value = ranks[0]
    document.getElementById('ranka2').value = ranks[1]
    document.getElementById('rankb3').value = ranks[2]
    document.getElementById('rankb4').value = ranks[3]
}

function classement3(a, b, c) {
    arr = [document.getElementById(a).value, document.getElementById(b).value, document.getElementById(c).value]
    sorted = arr.slice().sort(function (a, b) { return b - a })
    ranks = arr.map(function (v) { return sorted.indexOf(v) + 1 });
    document.getElementById('ranka1').value = ranks[0]
    document.getElementById('ranka2').value = ranks[1]
    document.getElementById('rankb3').value = ranks[2]
}


function changed_role() {
    var role = document.getElementById("role").value;
    console.log(role);
    if (role == "Organisateur" || role == "Jury" || role == "Veuillez sélectionner un rôle") {
        document.getElementById("club").style.display = "none";
    }
    else {
        document.getElementById("club").style.display = "unset";
    }
}

function coockies_points6() {
    document.cookie = "pointsa1=" + document.getElementById("totalrandtecha1").value
    document.cookie = "pointsa2=" + document.getElementById("totalrandtecha2").value
    document.cookie = "pointsb3=" + document.getElementById("totalrandtechb3").value
    document.cookie = "pointsb4=" + document.getElementById("totalrandtechb4").value
    document.cookie = "pointsc5=" + document.getElementById("totalrandtechc5").value
    document.cookie = "pointsc6=" + document.getElementById("totalrandtechc6").value
}

function coockies_points5() {
    document.cookie = "pointsa1=" + document.getElementById("totalrandtecha1").value
    document.cookie = "pointsa2=" + document.getElementById("totalrandtecha2").value
    document.cookie = "pointsb3=" + document.getElementById("totalrandtechb3").value
    document.cookie = "pointsb4=" + document.getElementById("totalrandtechb4").value
    document.cookie = "pointsc5=" + document.getElementById("totalrandtechc5").value
}

function coockies_points4() {
    document.cookie = "pointsa1=" + document.getElementById("totalrandtecha1").value
    document.cookie = "pointsa2=" + document.getElementById("totalrandtecha2").value
    document.cookie = "pointsb3=" + document.getElementById("totalrandtechb3").value
    document.cookie = "pointsb4=" + document.getElementById("totalrandtechb4").value
}


function coockies_points3() {
    document.cookie = "pointsa1=" + document.getElementById("totalrandtecha1").value
    document.cookie = "pointsa2=" + document.getElementById("totalrandtecha2").value
    document.cookie = "pointsb3=" + document.getElementById("totalrandtechb3").value
}

function show_confirm() {
    document.getElementById('testt').style.display = "block";
}