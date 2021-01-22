@extends('frontend.layout')
@section('title','Anasayfa Başlığı')
@section('content')
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">{{$blog->blog_title}}</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home.Index')}}">Anasayfa</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('blog.Index')}}">Blog Listesi</a>
            </li>
            <li class="breadcrumb-item active">{{$blog->blog_title}}</li>
        </ol>

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">


            @if($blog->blog_file)
                <!-- Preview Image -->
                    <img class="img-fluid rounded" src="/images/blogs/{{$blog->blog_file}}" alt="">

                @endif

                <hr>


                <!-- Date/Time -->
                <p> Yayınlanma zamanı {{$blog->created_at->format('d-m-Y h:i')}}</p>

                <hr>

                <!-- Post Content -->
                {!! $blog->blog_content !!}
                <hr>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Son Bloglar</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($bloglist as $list)
                                <a href="{{route('blog.Detail',$list->blog_slug)}}"><li class="list-group-item" aria-current="true">{{$list->blog_title}}</li></a>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature
                        the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
@endsection
@section('css') @endsection
@section('js') @endsection
