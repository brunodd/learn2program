@extends('master')

@section('title')
    About the site
@stop
@section('head')
@include('web.homepagehead')
@stop
@section('content')
<h2>The Creators</h2>

<!----start-img-cursual---->
<div id="owl-demo" class="owl-carousel text-center">
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/armin2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br><h4><a href="/users/armin">Armin Halilovic</a></h4>
            <p>
                Senior Front End Engineer.
            </p>
        </div>
    </div>
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/fouad2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br>
            <h4><a href="/users/fouad">Fouad Kichauat</a></h4>
            <p>
                Lead Visual graphic expert.
            </p>
        </div>
    </div>
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/raphael2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br><h4><a href="/users/raphael">Raphael Assa</a></h4>
            <p>
                Lead Database engineer.
            </p>
        </div>
    </div>
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/bruno2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br><h4><a href="/users/bruno">Bruno De Deken</a></h4>
            <p>
                Senior Application designer.
            </p>
        </div>
    </div>
</div>
<!----//End-img-cursual---->
@stop
