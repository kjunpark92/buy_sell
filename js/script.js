// ----------------------------------
//          display error message
// ----------------------------------

// var post_edit_form = document.getElementById("post_edit_form");

// var requiredField = post_edit_form.querySelectorAll("select");

//     console.log(requiredField);

// post_edit_form.addEventListener('submit', function(e){
    
//     console.log(e);
//     var fieldLength = requiredField.length;

//     console.log(fieldLength);

//     for (var i=0; i<fieldLength; i++){
//         var fieldvalue= requiredField[i].value;
//         var valuelength= fieldvalue.length;
//         var error_msg= document.requiredField[i].querySelector(".error_msg");
//         if (valuelength<3){
//             error_msg.style.display ="inline-block";
//             e.preventDefault();
//         }
        
//     }

// });




var submit_button = document.getElementById("post_submit");

submit_button.addEventListener("click", function(e){
    
    var theForm= document.getElementById("post_edit_form");
    var requiredField = document.getElementsByClassName("post_edit required");

    var fieldLength = requiredField.length;

    for (var i=0; i<fieldLength; i++){

        var needToBeFilled= requiredField[i].lastElementChild;
        console.log(needToBeFilled);
        var fieldvalue= needToBeFilled.value;
        console.log(fieldvalue);
        var valuelength= fieldvalue.length;
        var error_msg=requiredField[i].firstElementChild;

        if (valuelength<3){
            error_msg.style.display ="inline-block";
            e.preventDefault();
        }
        
    }
});
})

// ----------------------------------
//          town selection
// ----------------------------------

function townSelection (select) {
    var myOptionToSelect = select.getAttribute("myOptionToSelect");
    var options = select.options;

    for(var index_option in options) {
        if(select.options[index_option].value && options[index_option].value.trim() == myOptionToSelect.trim()) {
            options[index_option].selected = true;
        }
    }
}

// ----------------------------------
//          password confirm
// ----------------------------------

function checkPassword (e1, e2){
    
}
