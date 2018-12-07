var save = document.querySelector('#save');
save.addEventListener('click', function(e) {
    if(e.target.value == "Register") {
        document.location.href = '../html/profile.php';
    } else {
        document.location.href = '../html/login.php';
    }
    
});


// ----------------------------------
//          town selection
// ----------------------------------

var district = document.getElementById("district");
var district_name = district.value; 

console.log(district_name);
console.log("hihi");

function town_select ()