@extends('front-end.layouts.app')

@section('content')
    @foreach($user as $u)
            @section('title', 'Thông tin người dùng -'.$u->name)
            <div class="jumbotron text-center">
                <h1 class="display-4">Họ tên : <b>{{$u->name}}</b></h1>

                <p>Mã sinh viên : <b>{{$u->student_id}}</b></p>
                <p>Lớp : <b>{{$u->class}}</b></p>
                <p>Khoa, ngành : <b>{{$u->department}}</b></p>
                <p>Ngày sinh : <b>{{date('d-m-Y', strtotime($u->date_of_birth))}}</b></p>
                <p class="lead">
                    <a class="btn btn-primary" href="/user/{{$u->id}}/edit" role="button"><i class="fa fa-pencil pr-2"></i>Sửa thông tin</a>
                </p>
            </div>
    @endforeach
    @stop
