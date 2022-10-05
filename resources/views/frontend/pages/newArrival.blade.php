@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Produk Baru</h4>
                <div class="underline mb-4"></div>
            </div>
            @forelse($newArrival as $item)
            <div class="col-md-3 shadow">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger"> Baru </label>
                        @if($item->productImage->count() > 0)
                        <a href="{{url('/category/'.$item->category->slug.'/'.$item->slug)}}">
                            <img src="{{asset($item->productImage[0]->image)}}" alt="{{$item->name}}">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$item->brand}}</p>
                        <h5 class="product-name">
                            <a href="{{url('/category/'.$item->category->slug.'/'.$item->slug)}}">
                                {{$item->name}}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">Rp.{{number_format("$item->selling_price");}}</span>
                            <span class="original-price">Rp.{{number_format("$item->original_price");}}</span>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="d-block btn btn-sm btn-warning"> <i class="fa fa-shopping-cart text-dark"></i> <b>Beli Sekarang</b></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 p-2">
                <h4 class="text-center">No Product Available</h4>
            </div>
            @endforelse
            <div class="text-center mt-3">
                <a href="{{ url('category')}}" class="btn btn-sm btn-outline-warning">View More</a>
            </div>
            <hr class="mt-3">
        </div>
    </div>
</div>

@endsection