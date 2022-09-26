@extends('layouts.app')

@section('title','Order')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="com-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">List Order</h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped shadow" id="orderList">
                            <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Nomer Resi</th>
                                    <th>Username</th>
                                    <th>Type Pembayaran</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Status</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->tracking_no}}</td>
                                    <td>{{$item->fullname}}</td>
                                    <td>{{$item->payment_mode}}</td>
                                    <td>{{$item->created_at -> format ('d-m-Y')}}</td>
                                    <td>{{$item->status}}</td>
                                    <td><a href="{{ url('order/'.$item->id) }}" class="btn btn-sm btn-primary shadow">Lihat</a></td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="7"> Tidak Ada Order</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{$order->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

