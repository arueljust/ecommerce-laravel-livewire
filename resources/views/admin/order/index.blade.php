@extends('layouts.admin')

@section('title','Order')

@section('content')

<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header shadow">
                        <h4><U> Order / Transaction </U></h4>
                    </div>
                    <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                    <select name="status" class="form-select">
                                        <option value=""> - Select Status - </option>
                                        <option value="in progress"{{Request::get('status')=='in progress' ? 'selected':''}}>In Progress</option>
                                        <option value="completed"{{Request::get('status')=='completed' ? 'selected':''}}>Completed</option>
                                        <option value="pending"{{Request::get('status')=='pending' ? 'selected':''}}>Pending</option>
                                        <option value="cancel"{{Request::get('status')=='cancel' ? 'selected':''}}>Cancel</option>
                                        <option value="out-for-delivery"{{Request::get('status')=='out-for-delivery' ? 'selected':''}}>Out For Delivery</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                            
                                <button type="submit" class="btn btn-sm btn-warning text-dark shadow"> Filter </button>
                            </div>
                        </div>
                    </form>
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
                                    <td><a href="{{ url('admin/order/'.$item->id) }}" class="btn btn-sm btn-outline-primary shadow">Lihat</a></td>
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

