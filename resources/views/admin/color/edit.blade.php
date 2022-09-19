@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4><U> Edit Color </U>
                    <a href="{{url('admin/color')}}" class="btn btn-warning btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/color/'.$color->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Color Name :</label>
                        <input type="text" name="name" value="{{$color->name}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code :</label>
                        <input type="text" name="code" value="{{$color->code}}" class="form-control"> 
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{$color->status ? 'checked':''}} style="width: 15px; height: 15px;"/>Check = Hidden , Uncheck = Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-sm btn-primary text-white">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection