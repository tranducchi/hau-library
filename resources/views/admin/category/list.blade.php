@extends('admin.layout.app')
@section('title', 'Danh sách môn')
@section('branch', 'Danh sách môn')
@section('content')

    <div class="col-md-10 offset-md-1">
        <table class="table bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên môn</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xoá</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($cat as $c)

            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$c->name}}</td>
                <td><a href="/admin/category/{{$c->slug}}/edit" class="btn btn-outline-info btn-sm"><i class="fa fa-pencil-alt"></i></a></td>
                <td>
                    <form action="{{ url('/admin/category', ['id' => $c->id]) }}" method="post">
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
            {{$cat->links()}}
        </div>
    </div>
@stop

