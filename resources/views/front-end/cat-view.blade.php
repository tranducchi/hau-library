@extends('front-end.layouts.app')


@section('content')
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h3>Môn học : <u>
                    {{$cat_name['name']}}
                </u></h3>
        </div>
    </div>
    <div class="row">
    @foreach($books as $b)
        {{-- one article--}}
            @section('title', 'Môn '.$cat_name['name'])


        <div class="col-lg-4 mb-3">
            <article>
                <div class="card">
                    <div class="thumb">
                        <img src="{{asset('/storage/covers/'.$b->cover)}}" class="card-img-top" alt="...">
                    </div>

                    <div class="card-body">
                        <div class="info-book d-flex justify-content-between">
                            <h5 class="card-title">{{$b->name}}</h5>
                            <p><i class="fa fa-eye pr-1"></i>{{$b->views}} Views</p>
                        </div>

                        <p class="card-text">
                            {{ str_limit($b->description, 80)}}
                        </p>
                        <div class="action d-flex justify-content-between">
                            <a href="/book/{{$b->slug}}" class="btn btn-outline-success">Xem chi tiết</a>
                            <?php $v = 0; ?>
                            @foreach(Cart::content() as $c)
                                @if($c->id == $b->id)
                                    <?php $v++ ?>
                                @else
                                @endif
                            @endforeach
                            @if( $v == 1)
                                <a href="{{$b->id}}" class="btn btn-success unbook"><i class="fa fa-check pr-2 " aria-hidden="true"></i>Đã thêm</a>
                            @else
                                <a href="{{$b->id}}" class="btn btn-info getbook"><i class="fa fa-rocket pr-2 " aria-hidden="true"></i>Mượn Sách</a>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        </div>

    @endforeach
        <div class="row">
            <div class="col-md-12 text-center">
                {{$books->links()}}
            </div>
        </div>

    </div>
    {{-- end one article--}}
    @stop
@section('script')
    <script>
        let count_cart = $('.cart-count');
        let number_cart = parseInt($('.cart-count').text());
        var loggedIn={!! json_encode(Auth::check()) !!};
        $('body').on('click','.getbook',function(e) {
            if(!loggedIn){
                e.preventDefault();
                alert("Bạn cần đăng nhập để mượn sách")
            }else{
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
                        $(local).replaceWith('<a href="'+id+'" class="btn btn-success unbook"><i class="fa fa-check pr-2 " aria-hidden="true"></i>Đã thêm</a>');
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
            }

        });
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
                    var div = $("a.btn.btn-success.btn-sm.unbook[href="+id+"]");
                    console.log(div);
                    $(div).replaceWith('<a href=\"'+id+'\"  class=\"btn btn-info  getbook\"><i class=\"fa fa-hand-o-right pr-2\" aria-hidden=\"true\"></i>Mượn Sách</a>');
                    number_cart-=1;
                    count_cart.html(number_cart)
                    console.log(result)
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
                    $(local).replaceWith(' <a href="'+id+'"  class="btn btn-info getbook"><i class="fa fa-rocket pr-2 " aria-hidden="true"></i>Mượn Sách</a>');
                    var div = $("a.text-danger[href|="+id+"]");
                    div.parent().remove();
                    number_cart-=1;
                    count_cart.html(number_cart)
                },
            });
        });
    </script>
    @stop
