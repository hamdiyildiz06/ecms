@extends('frontend.layout')
@section('title','Anasayfa Başlığı')
@section('content')
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">{{$page->page_title}}</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home.Index')}}">Anasayfa</a>
            </li>
            <li class="breadcrumb-item active">{{$page->page_title}}</li>
        </ol>

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">


            @if($page->page_file)
                <!-- Preview Image -->
                    <img class="img-fluid rounded" src="/images/pages/{{$page->page_file}}" alt="">
            @endif

                <hr>


                <!-- Date/Time -->
                <p> Yayınlanma zamanı {{$page->created_at->format('d-m-Y h:i')}}</p>

                <hr>

                <!-- Post Content -->
                {!! $page->page_content !!}
                <hr>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Son pagelar</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($pagelist as $list)
                                <a href="{{route('page.Detail',$list->page_slug)}}"><li class="list-group-item" aria-current="true">{{$list->page_title}}</li></a>
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
