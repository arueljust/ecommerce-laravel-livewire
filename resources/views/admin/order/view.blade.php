@extends('layouts.admin')

@section('title','Order Detail')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header shadow">
                <h4 class="text-warning"> Detail Order
                <a href="{{ url('admin/order') }}" class="btn btn-sm btn-primary text-white float-end shadow"> Kembali </a>
                </h4>           
            </div>
            <div class="card-body shadow">
                    <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-sm btn-outline-primary float-end shadow mx-1"> Download Invoice </a>
                    <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-sm btn-outline-warning float-end shadow mx-1"> View Invoice </a>
                <hr>

                <div class="row">
                    <div class="col-md-6 shadow">
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
                    <div class="col-md-6 shadow">
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
                <div class="table-responsive shadow">
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
        <div class="card border mt-3 shadow">
            <div class="card-body">
                <h4>Order Process (Order Status Update)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{ url('admin/order/'.$order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label>Update Order Status</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value=""> - Select Order Status - </option>
                                    <option value="in progress" {{Request::get('status')=='in progress' ? 'selected':''}}>In Progress</option>
                                    <option value="completed" {{Request::get('status')=='completed' ? 'selected':''}}>Completed</option>
                                    <option value="pending" {{Request::get('status')=='pending' ? 'selected':''}}>Pending</option>
                                    <option value="cancel" {{Request::get('status')=='cancel' ? 'selected':''}}>Cancel</option>
                                    <option value="out-for-delivery" {{Request::get('status')=='out-for-delivery' ? 'selected':''}}>Out For Delivery</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary text-white">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br/>
                        <h4 class="mt-3"> Current Order Status : <span class="text-uppercase">{{ $order->status }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
