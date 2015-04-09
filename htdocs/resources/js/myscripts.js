//TODO: Use module pattern

/**
 * @return {boolean}
 */
function CheckEmptySearchForm(word) {
    return (document.getElementById(word).value != "");
}

function SetScrollBoxToBottom(box){
    var myDiv = document.getElementById(box);
    myDiv.scrollTop = myDiv.scrollHeight;
}

function doModal() {
    $('#flash-overlay-modal').modal();
}

function alertSlideUp() {
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
}

function initPythonSyntax() {
    editAreaLoader.init({
        id : "yourcode",         // textarea id
        syntax: "python",        // syntax to be uses for highlighting
        start_highlight: true    // to display with highlight mode on start-up
    });
}