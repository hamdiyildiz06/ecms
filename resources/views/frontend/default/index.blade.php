@extends('frontend.layout')
@section('title','Anasayfa Başlığı')
@section('content')
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            @foreach($data['slider'] as $slider)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" {{$loop->first ? "class='active'" : null}} ></li>
            @endforeach
        </ol>

        <div class="carousel-inner" role="listbox">

            @foreach($data['slider'] as $slider)
            <div class="carousel-item {{$loop->first ? 'active' : null}}" style="background-image: url('images/sliders/{{$slider->slider_file}}')">
                <div class="carousel-caption d-none d-md-block">
                    @if(strlen($slider->slider_url) > 1)
                        <h3><a href="{{$slider->slider_url}}"> {{$slider->slider_title}} </a></h3>
                    @else
                        <h3>{{$slider->slider_title}}</h3>
                    @endif
                    <p>{{$slider->slider_content}}</p>
                </div>
            </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<!-- Page Content -->
<div class="container">

    <!-- Portfolio Section -->
    <h2 class="my-4">Blog</h2>

    <div class="row">
        @foreach($data['blog'] as $blog)
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('blog.Detail',$blog->blog_slug)}}"><img width="100" height="200" class="card-img-top" src="images/blogs/{{$blog->blog_file}}" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">{{$blog->blog_title}}</a>
                    </h4>
                    <p class="card-text">{!! mb_substr($blog->blog_content, 0, 150, 'UTF-8') !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-6">
            <h2>Modern Business Features</h2>
            <p>The Modern Business template by Start Bootstrap includes:</p>
            <ul>
                <li>
                    <strong>Bootstrap v4</strong>
                </li>
                <li>jQuery</li>
                <li>Font Awesome</li>
                <li>Working contact form with validation</li>
                <li>Unstyled page elements for easy customization</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
        </div>
        <div class="col-lg-6">
            <img class="img-fluid rounded" src="http://placehold.it/700x450" alt="">
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
        </div>
        <div class="col-md-4">
            <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
        </div>
    </div>

</div>
<!-- /.container -->
@endsection
@section('css') @endsection
@section('js') @endsection
