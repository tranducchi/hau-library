@extends('admin.layout.app')
@section('title', 'Thêm sách')
@section('branch', 'Thêm sách')
@section('content')
<div class="col-md-10 offset-md-1">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-book pr-2"></i>Sách</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                @if (session('success'))
                    <p class="alert alert-success" data-dismiss="alert">{{session('success')}}</p>
                @endif
            <form action="/admin/book" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="vd : Lý Đại Cương">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Sách học phần I + II">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bộ môn</label>
                            <select name="cat_id" id="" class="form-control">
                                @foreach($cat as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>

                                @endforeach
                            </select>
                        </div>

                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tác giả</label>
                        <input type="text" name="composer" class="form-control" id="exampleInputEmail1" placeholder="vd : Lý Đại Cương">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng</label>
                        <input class="form-control" name="quantity" value="4" type="number" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ảnh bìa</label>
                        <input type="file" name="cover" class="custom-file">
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-md-12 text-center">
                    <button class="btn btn-info" type="submit">
                        <i class="fa fa-pencil-alt pr-1"></i>
                        Thêm
                    </button>
                </div>
            </div>
            </form>
            <!-- /.row -->


            <!-- /.row -->
        </div>
        <!-- /.card-body -->

    </div>
</div>
@stop
