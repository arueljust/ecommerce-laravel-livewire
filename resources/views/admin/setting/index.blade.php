@extends('layouts.admin')

@section('title','Admin Setting')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <form action="{{ url('admin/setting') }}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Website Name</label>
                            <input type="text" name="website_name" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website Url</label>
                            <input type="text" name="website_url" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Page Title</label>
                            <input type="text" name="title" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_keyword" class="form-control" rows="3"></textarea>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection