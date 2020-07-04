@extends('front-end.layouts.app')
@section('title', '')
@section('content')
        @foreach($book as $b)
        <div class="card">
            <div class="card-header text-center">
                <i class="fa fa-book pr-1"></i>Thông tin sách
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-md-4">
                    <h4>
                        <i class="fa fa-deaf pr-2"></i>Sách liên quan
                    </h4>
                    <div class="relation-book">
                        <div class="p-1">
                            {{-- One book--}}
                            @foreach($book_relation as $br)
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="img-relation">
                                        <a href="/book/{{$br->slug}}">
                                        <img class="card-img-top" src="{{asset('/storage/covers/'.$br->cover)}}" alt="Card image cap">
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <h5><a href="/book/{{$br->slug}}"> - {{$br->name}}</a></h5>
                                    <div class="info-detail-book">
                                        <p><i class="fa fa-eye pr-2"></i>Lượt xem : <b>{{$br->views}}</b></p>
                                        <p>Số lượng : <b>{{$br->quantity}}</b></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{-- End One book--}}
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-image">
                        <img width="300" src="{{asset('/storage/covers/'.$b->cover)}}" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li>Tên sách : <b>{{$b->name}}</b></li>
                        <li>Số lượng : <b>{{$b->quantity}}</b></li>
                        <li>Tác giả : <b>{{$b->composer}}</b></li>
                        <li>Bộ môn : <b>{{$b->category->name}}</b></li>
                        <li>Mô tả : <b>{{$b->description}}</b></li>
                        <li>Lượt xem :  <b>{{$b->views}}</b> lượt</li>
                        <div class="col-md-12 text-center mt-3">
                            <?php $v = 0; ?>
                            @foreach(Cart::content() as $c)
                                @if($c->id == $b->id)
                                    <?php $v++ ?>
                                @else
                                @endif
                            @endforeach
                            @if( $v == 1)
                                <a href="{{$b->id}}" class="btn btn-success btn-lg unbook"><i class="fa fa-check pr-2 " aria-hidden="true"></i>Đã thêm</a>
                            @else
                                <a href="{{$b->id}}" class="btn btn-info btn-lg getbook"><i class="fa fa-hand-o-right pr-2" aria-hidden="true"></i>Mượn ngay</a>
                            @endif
                        </div>

                    </ul>
                </div>
                </div>
            </div>


    </div>
        @endforeach
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
                    console.log("ok");
                    var div = $("a.btn.btn-success.btn-lg.unbook[href="+id+"]");
                    console.log(div);
                    $(div).replaceWith('<a href=\"'+id+'\"  class=\"btn btn-info btn-lg getbook\"><i class=\"fa fa-hand-o-right pr-2\" aria-hidden=\"true\"></i>Mượn Sách</a>');
                    number_cart-=1;
                    count_cart.html(number_cart)
                    console.log(result)
                }
            });
        }
        $('body').on('click','.getbook',function(e) {
            var local = $(this);
            e.preventDefault();
            var id = $(this).attr('href');
            $.ajax({
                url : "/getbooks/"+id,
                type : "get",
                dateType:"text",
                data : {
                },
                success : function (result){
                    console.log(result)
                    $(local).replaceWith('<a href="'+id+'" class="btn btn-success btn-lg unbook"><i class="fa fa-check pr-2 " aria-hidden="true"></i>Đã thêm</a>');
                    var book =
                        '                                <li class="list-group-item d-flex justify-content-between">' +
                        '                                    <div class="thumb-cart">' +
                        '                                        <img src="/storage/covers/'+result['cover']+'" alt="">' +
                        '                                    </div>' +
                        '                                    <a href="/book/'+result['slug']+'"> '+result['name']+'</a>' +
                        '                                    <a href="'+result['id']+'" class="fa fa-times-circle text-danger" onclick="unBook(this,'+result['id']+');return false;" style="font-size: 21px;text-decoration: none"></a>' +
                        '                                </li>'
                    $('.order-book').append(book)
                    // raise number cart
                    number_cart+=1;
                    count_cart.html(number_cart)
                },
                error: function (error) {
                    alert("Sách đã hết")
                }
            });
        });
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
                    $(local).replaceWith(' <a href="'+id+'"  class="btn btn-info btn-lg getbook"><i class="fa fa-hand-o-right pr-2" aria-hidden="true"></i>Mượn Sách</a>');
                    var div = $("a.text-danger[href|="+id+"]");
                    div.parent().remove();
                    number_cart-=1;
                    count_cart.html(number_cart)
                },
            });
        });
    </script>
    @stop

