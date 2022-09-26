@extends('layouts.app')

@section('title','Order')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="com-md-12">
                <div class="shadow bg-white p-3">

                    <h4 class="text-warning">
                        <i class="fa fa-shopping-cart text-dark"></i> Detail Order
                        <a href="{{ url('order') }}" class="btn btn-sm btn-outline-primary float-end shadow"> Kembali </a>
                    </h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Detail Order</h5>
                            <hr>
                            <h6>Nomer Order : {{$order->id}}</h6>
                            <h6>Nomer Resi : {{$order->tracking_no}}</h6>
                            <h6>Tanggal Order : {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                            <h6>Type Pembayaran : {{$order->payment_mode}}</h6>
                            <h6 class="border p-2 text-success">
                                Status Order : <span class="text-uppercase">{{$order->status}}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>Detail User</h5>
                            <hr>
                            <h6>Nama : {{$order->fullname}} </h6>
                            <h6>Email : {{$order->email}} </h6>
                            <h6>No Telp (WA) : {{$order->Phone}}</h6>
                            <h6>Alamat : {{$order->address}} </h6>
                            <h6>Kode Pos : {{$order->pincode}} </h6>
                        </div>
                    </div>

                    <br />
                    <h5>Order Item</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped shadow" id="orderList">
                            <thead>
                                <tr>
                                    <th width="10px">ID</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalAmount=0;
                                @endphp
                                @foreach($order->orderItem as $item)
                                <tr>
                                    <td width="10%">{{$item->id}}</td>
                                    <td width="10%">
                                        @if($item->product->productImage)
                                        <img src="{{url($item->product->productImage[0]->image)}}" style="width: 50px; height: 50px" alt="">

                                        @else
                                        <img src="" style="width: 50px; height: 50px" alt="">
                                        @endif
                                    </td>
                                    <td> {{$item->product->name}}</td>
                                    <td width="10%">Rp.{{number_format($item->price)}}</td>
                                    <td width="10%">{{$item->quantity}}</td>
                                    <td width="10%" class="fw-bold">Rp.{{number_format($item->quantity * $item->price)}}</td>
                                    @php
                                    $totalAmount += $item->quantity * $item->price;
                                    @endphp
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="5" class="fw-bold">Total :</td>
                                    <td colspan="1" class="fw-bold">Rp.{{number_format($totalAmount)}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection