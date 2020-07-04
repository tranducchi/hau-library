@extends('admin.layout.app')
@section('title', 'Danh sách môn')
@section('branch', 'Danh sách môn')
@section('content')
    <div class="col-md-10 offset-md-1">
        <table class="table bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Vai trò</th>
                <th scope="col">Số sách mượn</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($user as $u)

                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$u->name}}</td>
                    <td>
                        @if($u->role ==0)
                            <small class="badge badge-success">

                                Người dùng
                            </small>
                        @else
                            <small class="badge badge-danger">

                                Admin
                            </small>
                        @endif

                    </td>
                    <td>
                        {{$u->getbooks->where('status',2)->count()}}
                    </td>
                </tr>

                <?php $i++; ?>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-12 d-flex justify-content-center">
            {{$user->links()}}
        </div>
    </div>
@stop

