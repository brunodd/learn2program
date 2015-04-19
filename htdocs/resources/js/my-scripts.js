//Using module pattern as explained here: http://addyosmani.com/resources/essentialjsdesignpatterns/book/#modulepatternjavascript

var myScripts = (function () {

    return {
        //Checks if the search box in the navigation bar is empty.
        CheckEmptySearchForm: function (word) {
            return (document.getElementById(word).value != "");
        },

        //Sets the scroll bar to the bottom in a box, e.g. in messages
        SetScrollBoxToBottom: function (box) {
            var myDiv = document.getElementById(box);
            myDiv.scrollTop = myDiv.scrollHeight;
        },

        //If you use Flash::overlay('...'), display the alert/modal.
        doModal: function () {
            $('#flash-overlay-modal').modal();
        },

        //Slide up non-important alerts/messages after 3 seconds.
        alertSlideUp: function () {
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        },

        //Initialize the python syntax highlighter
        initPythonSyntax: function () {
            editAreaLoader.init({
                id: "yourcode",          // textarea id
                syntax: "python",        // syntax to be uses for highlighting
                start_highlight: true    // to display with highlight mode on start-up
            });
        },

        removeStyle: function (id) {
            document.getElementById(id).style.color = "darkgrey";
        }
    }
}());


//Example
/*
    var myNamespace = (function () {
        var myPrivateVar, myPrivateMethod;

        // A private counter variable
        myPrivateVar = 0;

        // A private function which logs any arguments
        myPrivateMethod = function( foo ) {
            console.log( foo );
        };

        return {
            // A public variable
            myPublicVar: "foo",

            // A public function utilizing privates
            myPublicFunction: function( bar ) {
                // Increment our private counter
                myPrivateVar++;

                // Call our private method using bar
                myPrivateMethod( bar );
            }
        };
    })();
 */