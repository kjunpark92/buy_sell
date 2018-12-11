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
//          display error message
// ----------------------------------

var post_edit_form = document.getElementById("post_edit_form");


post_edit_form.addEventListener('submit', function(e){
    var requiredField = post_edit_form.querySelectorAll("input[type=text], select, textarea");

    var fieldLength = requiredField.length;

    console.log(fieldLength);

    for (var i=0; i<fieldLength; i++){
        var fieldvalue= requiredField[i].value;
        var valuelength= fieldvalue.length;
        var error_msg= document.querySelector(".error_msg");
        if (valuelength<3){
            error_msg.style.display ="inline-block";
        }
    }

});
