@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header shadow">
                <h4><U> Add Product </U>
                    <a href="{{url('admin/product')}}" class="btn btn-warning btn-sm float-end shadow">Back</a>
                </h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-warning">
                    @foreach($errors->any() as $error)
                    <div>
                        {{$error}}
                    </div>
                    @endforeach
                </div>
                @endif
                <form action="{{url('admin/product')}}" method="POST" enctype="multipart/form-data">@csrf
                    <ul class="nav nav-tabs shadow" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                <h4>Home</h4>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seotags-tab" data-bs-toggle="tab" data-bs-target="#seotags-tab-pane" type="button" role="tab" aria-controls="seotags-tab-pane" aria-selected="false">
                                <h4>SEO Tags</h4>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane" aria-selected="false">
                                <h4>Detail</h4>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                <h4>Product Image</h4>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">
                                <h4>Product Color</h4>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active shadow " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><br>
                            <div class="mb-3">
                                <label>Category</label>
                                <select class="form-control shadow" name="category_id">
                                    @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>{product Name</label>
                                <input type="text" name="name" class="form-control shadow" />
                            </div>
                            <div class="mb-3">
                                <label>{product Slug</label>
                                <input type="text" name="slug" class="form-control shadow" />
                            </div>
                            <div class="mb-3">
                                <label>Select Brand</label>
                                <select class="form-control shadow" name="brand">
                                    @foreach ($brand as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>{Small Description (500 Words)</label>
                                <textarea name="small_description" rows="2" class="form-control shadow"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="2" class="form-control shadow"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="seotags-tab-pane" role="tabpanel" aria-labelledby="seotags-tab" tabindex="0"><br>
                            <div class="mb-3">
                                <label>{Meta Title</label>
                                <input type="text" name="meta_title" class="form-control shadow" />
                            </div>
                            <div class="mb-3">
                                <label>{Meta Description</label>
                                <textarea name="meta_description" rows="2" class="form-control shadow"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>{Meta Keyword</label>
                                <textarea name="meta_keyword" rows="2" class="form-control shadow"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab" tabindex="0"><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="text"  name="original_price" class="form-control shadow" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="text" name="selling_price" class="form-control shadow" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control shadow" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" class="shadow" name="trending" style="width: 15px; height: 15px;" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Featured</label>
                                        <input type="checkbox" class="shadow" name="featured" style="width: 15px; height: 15px;" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" class="shadow" name="status" style="width: 15px; height: 15px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0"><br>
                            <div class="mb-3">
                                <label>Upload Image Product</label>
                                <input type="file" name="image[]" class="form-control shadow" multiple />
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0"><br>
                            <div class="mb-3">
                                <label>Select Color :</label>
                                <hr/>
                                <div class="row">
                                    @forelse($color as $Coloritem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">

                                           Color : <input type="checkbox" name="color[{{$Coloritem->id}}]" value="{{$Coloritem->id}}" />
                                            {{$Coloritem->name}}
                                            <br>
                                            Quantity : <input type="number" name="colorquantity[{{$Coloritem->id}}]" style="width:70px; border: 1px solid"/>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-md-12">
                                        <h1>No Color Found</h1>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary float-end text-white shadow">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>

</script>
@endpush