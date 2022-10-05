<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border shadow" wire:ignore>
                        @if($product->productImage)
                        <!-- <img src="{{asset($product->productImage[0]->image)}}" class="w-100" alt="Img"> -->
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach($product->productImage as $prodImg)
                                    <li><img src="{{ asset($prodImg->image) }}" /></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn shadow"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn shadow"> > </a>
                            </p>
                        </div>
                        @else
                        <h4>Tidak Ada Gambar</h4>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}

                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{$product->category->name}} / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">Rp.{{number_format("$product->selling_price")}}</span>
                            <span class="original-price">Rp.{{number_format("$product->original_price")}}</span>
                        </div>
                        <div>
                            @if($product->quantity)
                            <label class="btn btn-sm py-1 mt-2 text-white bg-success"> Tersedia </label>
                            @else
                            <label class="btn btn-sm py-1 mt-2 text-white bg-danger"> Habis </label>
                            @endif
                        </div>
                        <div>
                            <label>Tersisa {{$product->quantity}}</label>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus shadow"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus shadow"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1 shadow">
                                <span wire:loading.remove wire:target="addToCart">
                                    <i class="fa fa-shopping-cart"></i> Tambah ke Cart
                                </span>
                                <span wire:loading wire:target="addToCart">Menambahkan...</span>

                            </button>
                            <button type="button" wire:click="addToWishList({{$product->id}})" class="btn btn1 shadow">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Tambah ke wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList">Menambahkan...</span>
                            </button>
                        </div>

                        <div class="mt-3">
                            <h5 class="mb-0">Deskripsi Singkat</h5>
                            <p>
                                {{$product->small_description}}
                            </p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3 ">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Deskripsi</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{$product->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function() {

        $("#exzoom").exzoom({
            "navWidth": 50,
            "navHeight": 50,
            "navItemNum": 5,
            "navItemMargin": 7,
            "navBorder": 2,
            "autoPlay": false,
            "autoPlayTimeout": 2000,
            responsive: 0,
        
        });

    });
</script>
@endpush