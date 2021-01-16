@extends('backend.layout')
@section('content')

    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Düzenleme Sayfası</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.update',$sliders->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($sliders->slider_file)
                        <div class="form-group">
                            <label>Yüklü Görsel</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" src="/images/sliders/{{$sliders->slider_file}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_file" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_title" value="{{$sliders->slider_title}}" required type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_slug" value="{{$sliders->slider_slug}}" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Url</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_url" value="{{$sliders->slider_url}}" type="url">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea name="slider_content" id="editor1">{{$sliders->slider_content}}</textarea>
                                    <script>
                                        CKEDITOR.replace('editor1');
                                    </script>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Durumu</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="slider_status" class="form-control">
                                    <option {{$sliders->slider_status == 1 ? 'selected' : null}} value="1">Aktif</option>
                                    <option {{$sliders->slider_status == 0 ? 'selected' : null}} value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="slider_must" value="{{$sliders->slider_must}}">
                    <input type="hidden" name="old_file" value="{{$sliders->slider_file}}">

                    <div class="box-footer" align="right">
                        <button type="submit" class="btn btn-success">Düzenle</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('css')@endsection
@section('js')@endsection
