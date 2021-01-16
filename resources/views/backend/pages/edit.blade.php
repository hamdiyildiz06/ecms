@extends('backend.layout')
@section('content')

    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Page Düzenleme Sayfası</h3>
            </div>
            <div class="box-body">
                <form action="{{route('page.update',$pages->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($pages->page_file)
                        <div class="form-group">
                            <label>Yüklü Görsel</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" src="/images/pages/{{$pages->page_file}}" alt="">
                                </div>
                            </div>
                        </div>

                    @endif
                    <div class="form-group">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="page_file" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="page_title" value="{{$pages->page_title}}" required type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="page_slug" value="{{$pages->page_slug}}" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea name="page_content" id="editor1">{{$pages->page_content}}</textarea>
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
                                <select name="page_status" class="form-control">
                                    <option {{$pages->page_status == 1 ? 'selected' : null}} value="1">Aktif</option>
                                    <option {{$pages->page_status == 0 ? 'selected' : null}} value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="page_must" value="{{$pages->page_must}}">
                    <input type="hidden" name="old_file" value="{{$pages->page_file}}">

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
