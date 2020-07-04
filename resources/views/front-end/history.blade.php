@extends('front-end.layouts.app')
@section('title', 'Lịch sử mượn sách')
@section('content')
    <div class="row col-md-6 offset-md-3 text-center mb-3">

            <select class="form-control" id="show-book">
                <option value="0">Hiện tất cả</option>
                <option value="1">Đang xử lý</option>
                <option value="2">Đang mượn </option>
                <option value="4">Đã trả</option>
            </select>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên sách</th>
            <th scope="col">Ảnh sách</th>
            <th scope="col">Ngaỳ mượn</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Trả sách</th>
        </tr>
        </thead>
        <tbody id="fil-content">
        <?php $i = 1 ?>
        @foreach($history->getbooks as $h)
            @if($h->status ==0 ||$h->status ==1 ||$h->status ==2 || $h->status==4)

                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$h->aboutBook->name}}</td>
                        <td><img height="100" src="/storage/covers/{{$h->aboutBook->cover}}" alt=""></td>
                        <td>
                            @if($h->status ==2 || $h->status ==4)
                               {{date('d-m-Y', strtotime($h->updated_at))}}
                                @endif
                        </td>
                        <td>
                            @if($h->status ==2)
                                <span class="badge badge-success">Đang mượn</span>
                            @elseif($h->status ==1)
                                <span class="badge badge-warning">Đang xử lý</span>
                            @elseif($h->status ==4)
                                <span class="badge badge-info">Đã trả</span>
                            @else
                                <span class="badge badge-danger">Từ chối</span>
                            @endif
                        </td>
                        <td>
                            @if($h->status ==2)
                                <form action="{{ url('/refund/'.$h->id) }}" method="post">
                                    <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('Xác nhận trả sách !');"><i class="fa fa-send"></i></button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            @endif
                        </td>
                    </tr>
                    <?php $i++; ?>
            @endif

        @endforeach
        </tbody>
    </table>
@stop
@section('script')
<script>
    //fil book on condition
    $("#show-book").change(function(){
        var con = $(this).val();
        // $('#fil-content').text('helo')
        $.ajax({
            url : "/fillbook/"+con,
            type : "get",
            dateType:"text",
            data : {
            },
            success : function (result){
                 $('#fil-content').html(result)

            }
        });
    });






    //remove product
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
                var div = $("a.btn.btn-success.btn-sm.unbook[href="+id+"]");
                console.log(div);
                $(div).replaceWith('<a href=\"'+id+'\"  class=\"btn btn-info btn-sm getbook\"><i class=\"fa fa-rocket pr-2 \" aria-hidden=\"true\"></i>Mượn Sách</a>');
                number_cart-=1;
                count_cart.html(number_cart)
                console.log(result)
            }
        });
    }
</script>
@stop
