//Using module pattern as explained here: http://addyosmani.com/resources/essentialjsdesignpatterns/book/#modulepatternjavascript

var skulptFunctions  = (function () {
    var outf, builtinRead;
    var result;

    // output functions are configurable. This one just appends some text to a pre element.
    outf = function (text) {
        var mypre = document.getElementById("output");
        mypre.innerHTML = mypre.innerHTML + text;
        result = text;
    };

    builtinRead = function (x) {
        if (Sk.builtinFiles === undefined || Sk.builtinFiles["files"][x] === undefined)
            throw "File not found: '" + x + "'";
        return Sk.builtinFiles["files"][x];
    };

    var success = true;
    return {
        // Here's everything you need to run a python program in skulpt
        // grab the code from your textarea
        // get a reference to your pre element for output
        // configure the output function
        // call Sk.importMainWithBody()
        runit: function () {
            var prog = document.getElementById("yourcode").value;
            var mypre = document.getElementById("output");
            mypre.innerHTML = '';
            Sk.pre = "output";
            Sk.configure({output:outf, read:builtinRead, execLimit:120000}); // timelimit = 120 seconds (2 minutes)
            (Sk.TurtleGraphics || (Sk.TurtleGraphics = {})).target = 'yourcanvas';
            var myPromise = Sk.misceval.asyncToPromise(function() {
                return Sk.importMainWithBody("<stdin>", false, prog, true);
            });
            myPromise.then(function(mod) {
                    console.log('success');
                },
                function(err) {
                    alert('Learn2Program found\n' + err.toString());
                    document.getElementById("output").innerHTML = err.toString(); //this is useless atm
                    console.log(err.toString());
                }
            );
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
