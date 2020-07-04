@extends('front-end.layouts.app')
@section('title', 'Cập nhật thông tin')
    @section('content')
        @foreach($user as $u)
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center p-2">Cập nhật thông tin : </h3>
                <br>
                @if ($errors->any())

                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                    @endforeach

                @endif
                @if (session('success'))
                    <p class="alert alert-success" data-dismiss="alert">{{session('success')}}</p>
                @endif
                <form action="/user/{{$u->id}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label  class="col-md-5 col-form-label">Mã sinh viên</label>
                                <div class="col-md-7">
                                    <input type="text" name="student_id" class="form-control" value="{{$u->student_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Họ tên</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="inputPassword" value="{{$u->name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Lớp</label>
                                <div class="col-sm-9">
                                    <input type="text" name="class" value="{{$u->class}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Khoa, ngành</label>
                                <div class="col-sm-8">
                                    <input type="text" name="department" class="form-control" value="{{$u->department}}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Ngành sinh</label>
                        <div class="col-sm-10">
                            <input type="date" name="birth" value="{{$u->date_of_birth}}" class="form-control" id="inputPassword" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label">{{ __('Mật khẩu mới') }}</label>

                        <div class="col-md-10">
                            <input id="password" type="password" placeholder="Nhập mật khẩu mới" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-2 col-form-label">{{ __('Xác nhận mật khẩu') }}</label>
                        <div class="col-md-10">
                            <input id="password-confirm" placeholder="Nhập lại mật khẩu" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info"><i class="fa fa-repeat pr-2"></i>Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        @stop
