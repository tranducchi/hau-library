@extends('admin.layout.app')
@section('title', 'Slide')
@section('branch', 'Sửa Slide')
@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-sliders-h pr-2"></i></i>Slide</h3>

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
                    @foreach($slide as $s)
                <form action="/admin/slide/{{$s->id}}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input type="text" value="{{$s->title}}" name="title" class="form-control" id="exampleInputEmail1" placeholder="Tiêu đề slide">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea name="description"  id="" cols="30" rows="3" placeholder="Nhập mô tả" class="form-control">{{$s->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <img width="150" src="{{asset('/storage/covers/'.$s->image)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh bìa</label>
                                <input type="file" name="image" class="custom-file">
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

