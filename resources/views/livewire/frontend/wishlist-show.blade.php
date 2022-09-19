              <div>
                        <div class="py-3 py-md-5 bg-light">
                            <div class="container">
                                <h3>WishList</h3>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 shadow">
                                        <div class="shopping-cart">

                                            <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <h4>Produk</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Deskripsi</h4>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h4>Harga</h4>
                                                    </div>
                                                    <div class="col-md-2 text-center">
                                                        <h4>Hapus</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            @forelse($wishlist as $wishlistItem)
                                            @if($wishlistItem->product)
                                            <div class="cart-item shadow">
                                                <div class="row">
                                                    <div class="col-md-2 my-auto">
                                                        <a href="{{url('category/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug)}}">
                                                            <label class="product-name">
                                                                <img src="{{$wishlistItem->product->productImage[0]->image}}" style="width: 50px; height: 50px" alt="{{$wishlistItem->product->name}}">
                                                                {{$wishlistItem->product->name}}
                                                            </label>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6 my-auto">
                                                        <label>{{$wishlistItem->product->small_description}}</label>
                                                    </div>
                                                    <div class="col-md-2 my-auto">
                                                        <label class="price">Rp.{{number_format($wishlistItem->product->selling_price)}} </label>
                                                    </div>

                                                    <div class="col-md-2 col-12 my-auto text-center ">
                                                        <div class="remove">
                                                            <button type="button" wire:click="removeWishlistItem({{$wishlistItem->id}})" class="btn btn-danger btn-sm shadow">
                                                                <span wire:loading.remove wire:target="removeWishlistItem({{$wishlistItem->id}})">
                                                                    <i class="fa fa-trash "></i> Hapus
                                                                </span>
                                                                <span wire:loading wire:target="removeWishlistItem({{$wishlistItem->id}})"> <i class="fa fa-trash"></i> Menghapus...</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            @endif
                                            @empty
                                            <h4 class="text-center mb-2">Tidak ada produk di wishlist</h4>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
