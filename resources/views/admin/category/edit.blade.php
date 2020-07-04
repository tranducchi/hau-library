@extends('admin.layout.app')
@section('title', 'Thêm bộ môn')
@section('branch', 'Môn học')
@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-th-large pr-2"></i>Môn học</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                    @foreach($cat as $c)
                <form action="/admin/category/{{$c->slug}}" method="POST">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" value="{{$c->name}}" name="name" class="form-control" id="exampleInputEmail1" placeholder="vd : Vật lý">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea name="describe" cols="30" rows="3" placeholder="Nhập mô tả môn học" class="form-control">{{$c->description}}
                                </textarea>
                            </div>
                        </div>
                        <!-- /.col -->


                        <!-- /.col -->
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info">
                                <i class="fas fa-sync-alt pr-1"></i>
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </form>
                @endforeach
                <!-- /.row -->


                <!-- /.row -->
            </div>
            <!-- /.card-body -->

        </div>
    </div>
@stop

