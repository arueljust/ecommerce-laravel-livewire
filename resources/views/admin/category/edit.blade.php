@extends('layouts.admin')
@section('content')
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header shadow">
                        <h4><U> Edit Category </U>
                            <a href="{{url('admin/category')}}" class="btn btn-outline-warning btn-sm float-end shadow">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Name</label>
                                   <input type="text" name="name" value="{{$category->name}}" class="form-control shadow"/>
                                   @error('name') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Slug</label>
                                   <input type="text" name="slug" value="{{$category->slug}}" class="form-control shadow"/>
                                   @error('slug') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Description</label>
                                   <textarea name="description" id="" class="form-control shadow" rows="3">{{$category->description}}</textarea>
                                   @error('description') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Image</label>
                                   <input type="file" name="image" class="form-control shadow"/>
                                   <img src="{{url('upload/category/' .$category->image)}}" width="60px" height="60px"/>
                                   @error('image') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label><br/>
                                   <input type="checkbox" name="status" {{$category->status == '1' ? 'checked':''}}/>
                                   @error('status') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12">
                                    <h4>SEO Tags</h4>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Meta Title</label>
                                   <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control shadow"/>
                                   @error('meta_title') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Meta Keyword</label>
                                   <textarea name="meta_keyword" id="" rows="3" class="form-control shadow">{{$category->meta_keyword}}</textarea>
                                   @error('meta_keyword') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Meta Description</label>
                                   <textarea name="meta_description" id="" rows="3" class="form-control shadow">{{$category->meta_description}}</textarea>
                                   @error('meta_description') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary text-white float-end shadow" id="success">Update</button>
                                </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
<!-- <script>
  $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.success').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
    });
</script> -->
@endpush
