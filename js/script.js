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