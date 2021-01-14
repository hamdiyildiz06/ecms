@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Settings</h3>
            </div>
            <div class="box-body">
                <form action="" method="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Açılama</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" readonly type="text" value="{{$settings->settings_description}}" >
                            </div>
                        </div>
                    </div>

                    @if($settings->settings_type == "file")
                        <div class="form-group">
                            <label>Resim Seç</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="file">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>İçerik</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    @if($settings->settings_type == "text")
                                        <input class="form-control" type="text" name="settings_value" value="{{$settings->settings_value}}">
                                    @endif

                                    @if($settings->settings_type == "textarea")
                                        <textarea name="settings_value" id="" >{{$settings->settings_value}}</textarea>
                                    @endif

                                    @if($settings->settings_type == "ckeditor")
                                        <textarea name="settings_value" id="editor1" >{{$settings->settings_value}}</textarea>
                                    @endif

                                        <script>
                                            CKEDITOR.replace('editor1');
                                        </script>
                                </div>
                            </div>
                        </div>
                    @endif
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
