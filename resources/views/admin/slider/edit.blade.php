@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4><U> Edit Slider </U>
                    <a href="{{url('admin/slider')}}" class="btn btn-warning btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/slider/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title :</label>
                        <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description :</label>
                        <textarea name="description" class="form-control" rows="3">{{$slider->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image :</label>
                        <input type="file" name="image" class="form-control" />
                        <img src="{{asset("$slider->image")}}" style="width:50px; heigth:50px" alt="slider" />
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{$slider->status=='1' ? 'checked':''}} style="width: 15px; height: 15px;" /> <br> Check = Hidden , Uncheck = Visible
                    </div>
                    <hr>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-primary text-white float-end">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection