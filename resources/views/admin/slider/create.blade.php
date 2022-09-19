@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4><U> Add Slider </U>
                    <a href="{{url('admin/slider')}}" class="btn btn-warning btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/slider')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Title :</label>
                        <input type="text" name="title" class="form-control">
                        @error('title') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label>Description :</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        @error('description') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label>Image :</label>
                        <input type="file" name="image" class="form-control"/>
                        @error('image') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" style="width: 15px; height: 15px;"/> <br> Check = Hidden , Uncheck = Visible
                        @error('status') <small class="text-danger">{{$message}}</small>@enderror
                    </div><hr>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-primary text-white float-end">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection