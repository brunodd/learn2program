@extends('master')

@section('title')
    About the site
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
            <br><h4><a href="#">Armin Halilovic</a></h4>
            <p>
                Founder & CEO.
            </p>
        </div>
    </div>
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/fouad2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br>
            <h4><a href="#">Fouad Kichauat</a></h4>
            <p>
                Visual graphic expert.
            </p>
        </div>
    </div>
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/raphael2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br><h4><a href="#">Raphael Assa</a></h4>
            <p>
                Database engineer.
            </p>
        </div>
    </div>
    <div class="item">
        <div class="cau_left">
            <img class="lazyOwl" data-src="/images/web/bruno2-round.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left">
            <br><h4><a href="">Bruno De Deken</a></h4>
            <p>
                Application designer.
            </p>
        </div>
    </div>
</div>
<!----//End-img-cursual---->
@stop
