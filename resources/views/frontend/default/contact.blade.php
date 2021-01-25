@extends('frontend.layout')
@section('title','Anasayfa Başlığı')
@section('content')

<div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Bize
            <small>Ulaşabilirsiniz</small>
        </h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home.Index')}}">Anasayfa</a>
            </li>
            <li class="breadcrumb-item active">Contact</li>
        </ol>



        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-lg-8 mb-4">

                @if (Session::has('success'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ session('success') }}</li>
                        </ul>
                    </div>
                    <br>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                @endif
                <h3>İletişim Formu</h3>
                <form name="sentMessage" id="contactForm"  method="post">
                    @CSRF
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Ad Soyad:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ad Soyad" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Adresiniz" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Telefon:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon Numaranız" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mesajınız:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" name="message" maxlength="999" style="resize:none" placeholder="Lütfen Mesajınızı Girniz"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Send Message</button>
                </form>
            </div>
            <!-- Contact Details Column -->
            <div class="col-lg-4 mb-4">
                <h3>Adres Detayları</h3>
                <p>
                    {{$adres}}
                    <br>{{$ilce}} / {{$il }}
                    <br>
                </p>
                <p>
                    <abbr title="Phone"> <i class="fa fa-phone"> </i> </abbr> : {{$phone_sabit}}
                </p>
                <p>
                    <abbr title="Mobil"> <i class="fa fa-mobile"> </i> </abbr> : {{$phone_sabit}}
                </p>
                <p>
                    <abbr title="Email"> <i class="fa fa-envelope"> </i> </abbr>:
                    <a href="mailto:name@example.com">name@example.com
                    </a>
                </p>
                <p>
                    <abbr title="Hours"> <i class="fa fa-clock"> </i> </abbr>: Monday - Friday: 9:00 AM to 5:00 PM
                </p>
            </div>
        </div>
        <!-- /.row -->
    </div>

@endsection
@section('css') @endsection
@section('js') @endsection
