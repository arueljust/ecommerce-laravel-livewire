@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4><U> Slider List </U>
                    <a href="{{url('admin/slider/create')}}" class="btn btn-warning btn-sm float-end">+ Add Slider</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slider as $item)
                        <tr class="text-center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->description}}</td>
                            <td><img src="{{asset("$item->image")}}" style="width:70px; height:70px" alt="slider"></td>
                            <td>{{$item->status=='0'?'Visible':'Hidden'}}</td>
                            <td>
                                <a href="{{url('admin/slider/'.$item->id.'/edit')}}" class="btn btn-sm btn-outline-success">Edit</a>
                                <a href="{{url('admin/slider/'.$item->id)}}" onclick="return confirm('Are You Sure Delete This Slider')" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection