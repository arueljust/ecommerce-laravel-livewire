@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-inner">
        @foreach($slider as $key=>$item)


        <div class="carousel-item {{$key== 0 ? 'active':''}}">
            @if($item->image)
            <img src="{{asset("$item->image")}}" class="d-block w-100" alt="...">
            @endif
            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <h1 class="text-dark">{{$item->title}}</h1>
                    <p class="text-dark">{{$item->description}}</p>
                    <div>
                        <a href="" class="btn btn-slider">Get Now</a>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Selamat Datang di Zatoku</h4>
                <div class="underline mx-auto"></div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus metus aliquam eleifend mi in nulla posuere sollicitudin aliquam. Eu ultrices vitae auctor eu. Ipsum nunc aliquet bibendum enim. Morbi enim nunc faucibus a pellentesque sit amet porttitor eget. Malesuada fames ac turpis egestas maecenas pharetra. At augue eget arcu dictum varius duis. Convallis posuere morbi leo urna. Vitae ultricies leo integer malesuada nunc vel. Duis at consectetur lorem donec massa sapien faucibus et molestie. Volutpat ac tincidunt vitae semper quis lectus nulla. Leo in vitae turpis massa sed elementum tempus egestas sed.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Produk Trending
                    <a href="{{ url('/category') }}" class="btn btn-sm btn-outline-warning float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if($trendingProduct)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">

                    @foreach($trendingProduct as $item)
                    <div class="item">
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
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4 class="text-center">No Product Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Produk Baru
                    <a href="{{ url('/new-arrival') }}" class="btn btn-sm btn-outline-warning float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if($newArrival)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">

                    @foreach($newArrival as $item)
                    <div class="item">
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
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4 class="text-center">No Product Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Produk Unggulan
                    <a href="{{ url('/featured-product') }}" class="btn btn-sm btn-outline-warning  float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if($featuredProduct)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">

                    @foreach($featuredProduct as $item)
                    <div class="item">
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
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4 class="text-center">No Product Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.four-carousel').owlCarousel({
        loop: true,
        margin: 10,
        dots: true,
        nav: false,
        responsive: {
            // tampilan item yg ada di hp
            0: {
                items: 1
            },
            // tampilan yang ada di tablet
            600: {
                items: 3
            },
            // tampilan yang ada di pc
            1000: {
                items: 4
            }
        }
    })
</script>
@endsection