
// --------------------------------------------
//          password confirm in registration
// --------------------------------------------

function checkPassword (e1, e2){
    
}


// --------------------------------------------
//         town selection in registration
// --------------------------------------------

function townSelection (select) {
    var myOptionToSelect = select.getAttribute("myOptionToSelect");
    var options = select.options;

    for(var index_option in options) {
        if(select.options[index_option].value && options[index_option].value.trim() == myOptionToSelect.trim()) {
            options[index_option].selected = true;
        }
    }
}


// --------------------------------------------
//     display error message in post.php
// --------------------------------------------


var submit_button = document.getElementById("post_submit");

submit_button.addEventListener("click", function(e){
    
    var requiredField = document.getElementsByClassName("required");

    var fieldLength = requiredField.length;

    for (var i=0; i<fieldLength; i++){

        var needToBeFilled= requiredField[i].querySelector(".requiredField");
        var fieldvalue= needToBeFilled.value;
        var valuelength= fieldvalue.length;
        var error_msg=requiredField[i].querySelector('.error_msg');

        var category= document.getElementById("post_category");
        var cat_value= category.value;

        var price= document.getElementById("post_price");
        var price_value= price.value;

        if (valuelength<1){
            error_msg.style.display ="inline-block";
            e.preventDefault();
        }
        else if (category.value=="Select a Category"){
            error_msg.style.display="inline-block";
            e.preventDefault();
        }
        else if (price_value == isNaN){
            error_msg.style.display="inline-block";
            e.preventDefault();
        }     
    }
});

// --------------------------------------------
//     itempage / comment section
// --------------------------------------------


