@extends('admin.layout.app')
@section('title', 'Yêu cầu mượn sách')
@section('branch', 'Mượn sách')
@section('content')
        <div class="col-md-12">
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <table class="table" style="background: white">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sách</th>
                    <th scope="col">Người mượn</th>
                    <th scope="col">Ngày mượn</th>
                    <th scope="col">Đồng ý</th>
                    <th scope="col">Loại bỏ</th>
                </tr>
                </thead>
                <tbody>
                <?php $i =1; ?>
                @foreach($gb as $b)

                    @if($b->status == 1)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$b->aboutBook->name}}</td>
                            <td>{{$b->student->name}}</td>
                            <td>{{$b->updated_at->format('d/m/Y')}}</td>
                            <td>
                                <form action="/admin/order/{{$b->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                   <button class="bg-white border-0"><i class="fa fa-check-circle fa-2x  text-success" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            <td>
                                <form action="/admin/order/remove/{{$b->id}}" method="post">
                                    <button type="submit" class="bg-white border-0"><i class="fa fa-times-circle fa-2x text-danger"></i></button>
                                    @method('PUT')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endif

                @endforeach
                </tbody>
            </table>
        </div>
@stop
