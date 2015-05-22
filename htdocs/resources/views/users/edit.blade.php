@extends('master')

@section('head')
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons" });</script>
@stop

@section('title')
    Edit your account
@stop

@section('content')
    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-10 col-md-offset-1">
        {!! Form::model($user, ['url' => '/users/' . $user->username, 'method' => 'PUT', 'files' => 'true', 'role' => 'form']) !!}
            {!! Form::hidden('userId', $user->id) !!}
            {!! Form::hidden('oldUsername', $user->username) !!}

            <div class="form-group">
                {!! Form::label('username', 'New Username: ') !!}
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'New Username', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('pass', 'New Password: ') !!}
                {!! Form::password('pass', ['class' => 'form-control', 'placeholder' => 'Leave blank if you dont wan\'t to change']) !!}
            </div>

            <!--div class="form-group">
                {!! Form::label('pass_confirmation', 'Confirm Password: ') !!}
                {!! Form::password('pass_confirmation', ['class' => 'form-control', 'placeholder' => 'Leave blank if you dont wan\'t to change']) !!}
            </div-->

            <div class="form-group">
                {!! Form::label('mail', 'New Email: ') !!}
                {!! Form::text('mail', null, ['class' => 'form-control', 'placeholder' => 'New Email', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('info', 'Tell us about yourself: ') !!}
                {!! Form::textarea('info', null, ['class' => 'form-control', 'placeholder' => 'Don\'t be shy!']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Choose profile image: ') !!}
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>

             <div class="form-group">
                <div style="color: white;">
                    <a href="{{ action('UsersController@show', $user->username )}}" class="btn btn-primary pull-right" style="margin-left: 5px">
                        <i class="glyphicon glyphicon-remove-sign"></i> Cancel
                    </a>
                </div>
                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right']) !!}
                <div style="clear: both"></div>
            </div>
        {!! Form::close() !!}
        @include('errors.list')
    </div>
@stop

