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
            $('div.alert').not('.alert-danger').delay(3000).slideUp(300);
        },

        //Initialize the python syntax highlighter
        initPythonSyntax: function () {
            editAreaLoader.init({
                id: "yourcode",          // textarea id
                syntax: "python",        // syntax to be uses for highlighting
                start_highlight: true    // to display with highlight mode on start-up
            });
        },

        changeElementColor: function (id, color) {
            document.getElementById(id).style.color = color;
        },

        changeDataSort: function (id) {
            var s = document.getElementById(id).getAttribute('data-sort');
            var ss = (s.search('asc') > -1) ? s.replace('asc', 'desc') : s.replace('desc', 'asc');
            document.getElementById(id).setAttribute('data-sort', ss);
        },

        switchDataSort: function (id) {
            document.getElementById(id).setAttribute("hidden", true);
            var children = document.getElementById(id).parentNode.childNodes;

            var siblingList = [];
            for (var n = children.length - 1; n >= 0; n--) {
                if (children[n].nodeName == "BUTTON") {
                    var herrderr = children[n].getElementsByTagName("SPAN")[0];
                    herrderr.style.display = "none";
                    siblingList.push(herrderr);
                }
            }

            console.log("hi", siblingList);
            /*document.getElementById(id).removeClass("active");*/
            if (id.search(1) > -1) {
                document.getElementById(id.replace('1', '2')).removeAttribute("hidden");
                document.getElementById(id.replace('1', '2')).getElementsByTagName("SPAN")[0].style.display = "inline";
                //document.getElementById(id.replace('1', '2')).addClass("active");
            } else {
                document.getElementById(id.replace('2', '1')).removeAttribute("hidden");
                document.getElementById(id.replace('2', '1')).getElementsByTagName("SPAN")[0].style.display = "inline";
                /*document.getElementById(s.replace('2', '1')).addClass("active");*/
            }
        },

        initializeMixItUp: function () {
            $('#mix-wrapper').mixItUp({
                animation: {
                    effects: 'fade',
                    duration: 300
                },
                callbacks: {
                    onMixEnd: function(state) {
                        console.log(state)
                    }
                },
                controls: {
                    activeClass: 'derp'
                },
                layout: {
                    display: 'block'
                },
                load: {
                    sort: 'title:asc'
                }
            });
        },

        ajaxPostNotificationsRead: function() {
            $(function (){
                $(".nav #notifclick").click(function() {
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost:8000/notificationsRead',

                        success: function(data) {
                            console.log('succes', data);
                        },
                        error: function(data) {
                            console.log('fail', data);
                        }
                    });
                });
            });
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
