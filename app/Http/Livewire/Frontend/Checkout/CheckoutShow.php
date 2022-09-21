<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\Orderitem;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Request;
use Kavist\RajaOngkir\RajaOngkir;
use Illuminate\Support\Facades\Auth;


class CheckoutShow extends Component
{
    
    // private $apiKey = '6cdfb2421be44202e93ae35bb6d8a54c';
    // public $provinsi_id, $kota_id, $jasa, $daftarProvinsi, $daftarKota, $nama_jasa;
    // public $result = [];
    public $cart, $totalProductAmount = 0;
    public $orderItem, $weight;
    public $fullname, $nik, $Phone, $email, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;
  
    // panggil validasi function dari blade file
    protected $listeners=[
        'validationForAll',
        'transactionEmit'=>'paidOnlineOrder'
    ];

    public function paidOnlineOrder($value)
    {
        $this->payment_id=$value;
        $this->payment_mode='Paid by Paypall';

        $onlinePaid = $this->placeOrder();
        if ($onlinePaid) {

            session()->flash('message', 'Pesanan berhasil dan sedang diproses');
            // kosongkan cart jika checkout suksess
            Cart::where('user_id', auth()->user()->id)->delete();
            // hapus cart

            $this->dispatchBrowserEvent('message', [
                'text' => 'Order place success',
                'type' => 'success',
                'status' => 200
            ]);

            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }


    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'nik' => 'required|string|max:18|min:16',
            'Phone' => 'required|string|max:13|min:11',
            'email' => 'required|email|max:121',
            'pincode' => 'required|string|max:5|min:5',
            'address' => 'required|string|max:500',
        ];
    }


    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'ZTK-' . Str::random(10),
            'fullname' => $this->fullname,
            'nik' => $this->nik,
            'email' => $this->email,
            'Phone' => $this->Phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->cart as $cartItem) {

            $orderItem = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);

            if ($cartItem->product_id) {

                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }

        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash On Delivery';

        $codOrder = $this->placeOrder();
        if ($codOrder) {

            session()->flash('message', 'Pesanan berhasil dan sedang diproses');
            // kosongkan cart jika checkout suksess
            Cart::where('user_id', auth()->user()->id)->delete();
            // hapus cart

            $this->dispatchBrowserEvent('message', [
                'text' => 'Order place success',
                'type' => 'success',
                'status' => 200
            ]);

            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function totalAmount()
    {

        // $rajaOngkir = new RajaOngkir($this->apiKey);
        // $this->daftarProvinsi = $rajaOngkir->provinsi()->all();

        // if ($this->provinsi_id) {
        //     $this->daftarKota = $rajaOngkir->kota()->dariprovinsi($this->provinsi_id)->get();
        // }


        $this->totalProductAmount = 0;
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->cart as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $this->totalProductAmount;
    }

    

    // public function getOngkir()
    // {
    //     // validasi input
    //     if (!$this->provinsi_id || !$this->kota_id || !$this->jasa) {
    //         return;
    //     }

    //     // ambil data produk
    //     $this->cart = Cart::where('user_id', auth()->user()->id)->get();

    //     // set biaya ongkir
    //     $rajaOngkir = new RajaOngkir($this->apiKey);
    //     $cost = $rajaOngkir->ongkosKirim([
    //         'origin'        => 489,     // ID kota/kabupaten asal (tuban)
    //         'destination'   => $this->kota_id,      // ID kota/kabupaten tujuan
    //         'weight'        => 1000,    // berat barang dalam gram
    //         'courier'       => $this->jasa    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
    //     ])->get();

    //     // nama jasa buat sendiri
    //     $this->nama_jasa = $cost['0']['name'];

    //     foreach ($cost[0]['costs'] as $row) {
    //         $this->result[] = array(
    //             'description' => $row['description'],
    //             'cost' => $row['cost'][0]['value'],
    //             'etd' => $row['cost'][0]['etd']
    //         );
    //     }
    // }



    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
