@extends('backend.layout')
@section('content')

    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User Düzenleme Sayfası</h3>
            </div>
            <div class="box-body">
                <form action="{{route('user.update',$users->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($users->user_file)
                        <div class="form-group">
                            <label>Yüklü Görsel</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img width="100" src="/images/users/{{$users->user_file}}" alt="">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="user_file" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="name" value="{{$users->name}}" required type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kullanıcı Adı <small>( E-mail )</small></label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" value="{{$users->email}}" type="email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Şifre</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password">
                                <small>Şifreyi Değiştirmek istemiyorsanız boş bırakabilirsiniz...</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Durumu</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="user_status" class="form-control">
                                    <option {{$users->user_status == 1 ? 'selected' : null}} value="1">Aktif</option>
                                    <option {{$users->user_status == 0 ? 'selected' : null}} value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_must" value="{{$users->user_must}}">
                    <input type="hidden" name="old_file" value="{{$users->user_file}}">

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
