@extends('admin.layout.app')
@section('title', 'Sách')
@section('branch', 'Danh sách')
@section('content')
    <div class="col-md-10 offset-md-1">
        <table class="table bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sách</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xoá</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>

            @foreach($books as $b)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$b->name}}</td>
                    <td>
                        <img width="150" src="{{asset('storage/covers/'.$b->cover)}}" alt="">
                    </td>
                    <td>{{$b->composer}}</td>
                    <td><a href="/admin/book/{{$b->slug}}/edit" class="btn btn-outline-info btn-sm"><i class="fa fa-pencil-alt"></i></a></td>
                    <td>
                        <form action="{{ url('/admin/book', ['id' => $b->id]) }}" method="post">
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
{{--            {{$cat->links()}}--}}
        </div>
    </div>
@stop

