@extends('front-end.layouts.app')
@section('title','Sách đã chọn')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <h5 class="card-header text-center">Sách đã chọn</h5>
                <div class="card-body">
                    @if(Cart::content()->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Ảnh bìa</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach(Cart::content() as $c)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$c->name}}</td>
                            <input type="hidden"  name="bo_id" value="{{$c->id}}">
                            <td> <img width="100" src="/storage/covers/{{$c->options->img}}" alt=""></td>
                            <td><a href="{{$c->id}}" class="btn btn-danger btn-sm unbook"><i class="fa fa-times pr-2 " aria-hidden="true"></i>Loại bỏ</a></td>
                        </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <p class="alert alert-danger">Không có sách nào được chọn</p>
                    @endif
                </div>
                <div class="col-md-12 text-center pb-3">
                    <a href="/handle-request" class="btn btn-info"><i class="fa fa-paper-plane-o pr-2" aria-hidden="true"></i>Xác nhận</a>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        let count_cart = $('.cart-count');
        let number_cart = parseInt($('.cart-count').text());
        function unBook(l,e){
            var vt = l;
            var id = e;
            $.ajax({
                url : "/unbook/"+id,
                type : "get",
                dateType:"text",
                data : {
                },
                success : function (result){
                    $(vt).parent().remove();
                    var div = $("a.btn.btn-danger.btn-sm.unbook[href="+id+"]");
                    div.parent().parent().remove();
                    console.log(div);
                    number_cart-=1;
                    count_cart.html(number_cart)
                }
            });
        }
        $('body').on('click','.unbook',function(e) {
            e.preventDefault();
            var local = $(this);
            var id = $(this).attr('href');
            $.ajax({
                url : "/unbook/"+id,
                type : "get",
                dateType:"text",
                data : {
                },
                success : function (result){
                    local.parent().parent().remove();

                    var div = $("a.fa.fa-times-circle.text-danger[href="+id+"]");
                    div.parent().remove();
                    number_cart-=1;
                    count_cart.html(number_cart)
                },
            });
        });
    </script>
@stop
