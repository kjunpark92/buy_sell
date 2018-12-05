var save = document.querySelector('#save');
save.addEventListener('click', function() {
    document.location.href = '../html/.php';
});


// ----------------------------------
//          town selection
// ----------------------------------

var district = document.getElementById("district");
var district_name = district.value; 

console.log(district_name);
console.log("hihi");

function town_select ()