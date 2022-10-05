<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice # {{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start"><b>Zato</b>Ku</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: # {{ $order->id }}</span> <br>
                    <span>Tanggal : {{ date('d / m / Y')}}</span> <br>
                    <span>Kode Pos : 61262</span> <br>
                    <span>Alamat : Dsn.Tundungan Rt 4/Rw 2, Ds.Sidomojo, Kec.Krian, Kab.Sidoarjo </span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->id }}</td>

                <td>Nama :</td>
                <td>{{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>No. Resi :</td>
                <td>{{ $order->tracking_no }}</td>

                <td>Email :</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Tanggal Order :</td>
                <td>{{ $order->created_at->format('d-m-Y h:i A') }}</td>

                <td>No Telp :</td>
                <td>{{ $order->Phone }}</td>
            </tr>
            <tr>
                <td>Pembayaran :</td>
                <td>{{ $order->payment_mode }}</td>

                <td>Alamat :</td>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <td>Order Status :</td>
                <td>{{ $order->status }}</td>

                <td>Kode Pos :</td>
                <td>{{ $order->pincode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
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
                <td> {{$item->product->name}}</td>
                <td width="10%">Rp.{{number_format($item->price)}}</td>
                <td width="10%">{{$item->quantity}}</td>
                <td width="15%" class="fw-bold">Rp.{{number_format($item->quantity * $item->price)}}</td>
                @php
                $totalAmount += $item->quantity * $item->price;
                @endphp
            </tr>
            @endforeach

            <tr>
                <td colspan="4" class="total-heading">Total :</td>
                <td colspan="1" class="total-heading">Rp.{{number_format($totalAmount)}}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
       Terima Kasih Telah Berbelanja Di Zatoku
    </p>

</body>

</html>