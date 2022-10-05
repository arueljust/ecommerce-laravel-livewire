@extends('layouts.app')

@section('title','Kategori')

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Kategori</h4>
                <div class="underline mb-4"></div>
            </div>
            @forelse($category as $item)
            <div class="col-6 col-md-3 shadow">
                <div class="category-card">
                    <a href="{{url('/category/'.$item->slug)}}">
                        <div class="category-card-img">
                           <img src="{{asset("$item->image")}}" class="w-100" alt="Laptop">
                        </div>
                        <div class="category-card-body">
                            <h5>{{$item->name}}</h5>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <h5 class="text-center">
                    Tidak ada kategori  tersedia
                </h5>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
