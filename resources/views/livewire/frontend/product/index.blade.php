<div>
    <div class="row">
        <div class="col-md-3">
            @if($category->brand)
            <div class="card">
                <div class="card-header text-center shadow">
                    <h4>Brand</h4>
                </div>
                <div class="card-body shadow">
                    @foreach($category->brand as $brandItem)
                    <label class="d-block">
                        <input type="checkbox" wire:model="brandInput" value="{{$brandItem->name}}" /> {{$brandItem->name}}
                    </label>
                    @endforeach
                </div>
            </div>
            @endif
            <br>
            <div class="card">
                <div class="card-header text-center shadow">
                    <h4>Harga</h4>
                </div>
                <div class="card-body shadow">

                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"/> Tertinggi
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"/> Terendah
                    </label>

                </div>
            </div>
        </div>
        <div class="col-md-9 ">

            <div class="row">
                @forelse($product as $item)
                <div class="col-md-4 shadow">
                    <div class="product-card">
                        <div class="product-card-img">

                            @if($item->quantity > 0)
                            <label class="stock bg-success">Tersedia</label>
                            @else
                            <label class="stock bg-danger">Habis</label>
                            @endif
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
                        </div>
                    </div>
                </div>
                @empty

                <div class="col-md-12">
                    <div class="p-2">
                        <br>
                        <br>
                        <br>
                        <h4 class="text-center">No Product Available {{$category->name}}</h4>
                    </div>
                </div>

                @endforelse
            </div>
        </div>
    </div>
</div>
