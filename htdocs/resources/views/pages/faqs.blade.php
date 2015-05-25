@extends('master')

@section('title')
    FAQs
@stop

@section('content')
<div class="container">
    <h2>Q: Why can't I submit an answer for certain exercises?</h2>
    <h4> A: If the "Submit Answer" button is missing, it's indicating that you must first complete the preceding exercises from that series.</h4>
</div>
<br><hr/>

<div class="container">
    <h2>Q: Why can't I resend a friend requests after being removed as a friend?</h2>
    <h4> A: Only the user that stopped the friendship can resend a request.</h4>
</div>
<br><hr/>

<div class="container">
    <h2>Q: Does the code-editor only support syntax highlighting?</h2>
    <h4> A: The editor can do more than that. Note how brackets & quotes are automatically closed. The window also re-sizes automatically for your convenience. Finally, the editor supports auto-completion for both the selected programming language's syntax, as well as nearby words. Mind that the syntax depends on the current highlighting settings. Use the following key combinations:</h4><p> - CRTL+Space : auto-completion for syntactical keywords<br>- ALT+Space &nbsp;&nbsp;&nbsp;: auto-completion for any nearby words</p>
</div>
<br><hr/>

<div class="container">
    <h2>Q: Why is the question of my exercise so small?</h2>
    <h4> A: The editor that is used to write questions, guides & your profile information generates HTML code which is injected. You should use the tools in order to create a nice looking layout. We strongly encourage the good programmers with HTML and javascript experience to make interesting questions with the given tools. Since this functionality can be abused to create fishy things, we sincerely hope that users will not attempt to do so. Users that are caught doing so will be removed immediately by the Learn2Program team. If the staff feels the need to prosecute the perpetrator, they will not hesitate to do so!</h4>
</div>
<br><hr/>

<div class="container">
    <h2>Q: What is The Answer to the Ultimate Question of Life, The Universe, and Everything?</h2>
    <h4> A: 42</h4>
</div>
<br><hr/>


@stop

