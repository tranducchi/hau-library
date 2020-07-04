@extends('admin.layout.app')
@section('title', 'Slide')
@section('branch', 'Danh sách')
@section('content')
    {{--    {{dd($cat)}}--}}
    <div class="col-md-10 offset-md-1">
        <table class="table bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên Slide</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xoá</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($slides as $s)

                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$s->title}}</td>
                    <td>
                        <img width="150" src="{{asset('/storage/covers/'.$s->image)}}" alt="">
                    </td>
                    <td><a href="/admin/slide/{{$s->id}}/edit" class="btn btn-outline-info btn-sm"><i class="fa fa-pencil-alt"></i></a></td>
                    <td>
                        <form action="{{ url('/admin/slide', ['id' =>$s->id ]) }}" method="post">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xoá môn học ? ');"><i class="fa fa-times"></i></button>
                            @method('delete')
                            @csrf
                        </form>
                    </td>
                </tr>

                <?php $i++; ?>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12 d-flex justify-content-center">

        </div>
    </div>
@stop

