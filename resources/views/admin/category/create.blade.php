@extends('layouts.admin')
@section('content')
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header shadow">
                        <h4><U> Add Category </U>
                            <a href="{{url('admin/category')}}" class="btn btn-outline-warning btn-sm float-end shadow">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/category')}}" method="POST" enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Name</label>
                                   <input type="text" name="name" class="form-control shadow" placeholder="Masukkan nama kategori"/>
                                   @error('name') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Slug</label>
                                   <input type="text" name="slug" class="form-control shadow" placeholder="Masukkan slug produk"/>
                                   @error('slug') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Description</label>
                                   <textarea name="description" id="" class="form-control shadow" rows="3" placeholder="Masukkan deskripsi"></textarea>
                                   @error('description') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Image</label>
                                   <input type="file" name="image" class="form-control shadow" placeholder="Masukkan gambar .jpg/.jpeg/.png"/>
                                   @error('image') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                   <input type="checkbox" name="status"/>
                                   @error('status') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12">
                                    <h4>SEO Tags</h4>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Meta Title</label>
                                   <input type="text" name="meta_title" class="form-control shadow" placeholder="Masukkan title untuk alamat website"/>
                                   @error('meta_title') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Meta Keyword</label>
                                   <textarea name="meta_keyword" id="" rows="3" class="form-control shadow" placeholder="Masukkan SEO pencarian"></textarea>
                                   @error('meta_keyword') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="">Meta Description</label>
                                   <textarea name="meta_description" id=""  rows="3" class="form-control shadow" placeholder="Masukkan deskripsi"></textarea>
                                   @error('meta_description') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary text-white float-end shadow">Save</button>
                                </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
