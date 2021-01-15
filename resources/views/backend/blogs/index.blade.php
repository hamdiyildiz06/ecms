@extends('backend.layout')
@section('content')
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Blog</h3>
                <div align="right">
                    <a href="{{route('blog.create')}}">
                        <button class="btn btn-success"> Ekle</button>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Başlık</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($data['blog'] as $blog)
                        <tr id="item-{{$blog->id}}">
                            <td width="5">{{$blog->id}}</td>
                            <td class="sortable">{{$blog['blog_title']}}</td>
                            <td width="5"><a href="{{route('settings.Edit',['id'=>$blog->id])}}"><i class="fa fa-pencil-square"></i></a></td>
                            <td width="5"><a href="javascript:void(0)"><i id="{{$blog->id}}" class="fa fa-trash-o"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('blog.Sortable')}}",
                        success: function (msg) {
                            // console.log(msg);
                            if (msg) {
                                alertify.success("işlem başarılı");
                            } else {
                                alertify.error("işlem başarısız");
                            }
                        }
                    });
                }
            });
            $('#sortable').disableSelection();

        });

        $(".fa-trash-o").click(function (){
            destroy_id = $(this).attr('id');
            alertify.confirm('Silme İşlemini Onaylayın','Bu İşlem Geri Alınamaz',
                function (){
                  //  location.href = "/nedmin/settings/delete/" + destroy_id;

                    $.ajax({
                        type:"DELETE",
                        url:"blog/"+destroy_id,
                        success: function (msg){
                            if (msg) {
                                $("#item-"+destroy_id).remove();
                                alertify.success("işlem başarılı");
                            } else {
                                alertify.error("işlem başarısız");
                            }
                        }
                    });
                },
                function (){
                    alertify.error("Silme İşlemi İptal Edildi");
                }
            )
        });
    </script>
@endsection
@section('css')@endsection
@section('js')@endsection
