@extends('admin.layout.app')
@section('title', 'Yêu cầu trả sách')
@section('branch', 'Trả sách')
@section('content')
    <div class="col-md-10 offset-md-1">
        <table class="table bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Người trả</th>
                <th scope="col">Tên môn</th>
                <th scope="col">Chấp nhận</th>
                <th scope="col">Loại</th>
            </tr>
            <tbody>
            <?php $i=1; ?>
            @foreach($books as $b)
            <tr>
                <th scope="row"></th>
                <th scope="row">{{$b->student->name}}</th>
                <td>{{$b->aboutBook->name}}</td>
                <td>
                    <form action="{{ url('/admin/refund/list', ['id' => $b->id]) }}" method="post">
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Xác nhận trả sách');"><i class="fa fa-check"></i></button>
                        @method('PUT')
                        @csrf
                    </form>
                </td>
                <td>
                    <form action="{{ url('/admin/category', ['id' => $b->id]) }}" method="post">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Loại bỏ');"><i class="fa fa-times"></i></button>
                        @method('PUT')
                        @csrf
                    </form>
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            </tbody>
        </table>

            </tbody>
        </table>
        <div class="col-md-12 d-flex justify-content-center">

        </div>
    </div>
    @stop

