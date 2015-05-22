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
    Create a new guide
@stop

@section('content')
<div class="container col-md-10 col-md-offset-1">
    {!! Form::open(['url' => '/guides']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content: ') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Create guide', ['class' => 'btn btn-primary pull-right']) !!}
        </div>
    {!! Form::close() !!}
    <div><br><br>
    @include('errors.list')
    </div>
</div>
@stop
