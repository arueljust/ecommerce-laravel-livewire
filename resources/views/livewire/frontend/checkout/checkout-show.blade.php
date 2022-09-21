<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>

            @if($this->totalProductAmount != '0' )
            <div class="row">
                <div class="col-md-12 mb-4">

                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Identitas Diri
                        </h4>
                        <hr>

                        <form action="" method="POST" wire:submit.prevent="getOngkir">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" wire:model.defer="fullname" id="fullname" class="form-control shadow" placeholder="Masukkan nama lengkap" />
                                    @error('fullname') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" wire:model.defer="email" id="email" class="form-control shadow" placeholder="Masukkan alamat email @ .com/id" />
                                    @error('email') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>NIK</label>
                                    <input type="text" wire:model.defer="nik" id="nik" class="form-control shadow" placeholder="Masukkan NIK 16 digit" />
                                    @error('nik') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>No Telp (Whatsapp)</label>
                                    <input type="number" wire:model.defer="Phone" id="Phone" class="form-control shadow" placeholder="Masukkan nomor " />
                                    @error('Phone') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Kode Pos</label>
                                    <input type="number" wire:model.defer="pincode" id="pincode"  class="form-control shadow" placeholder="Masukkan kode pos" />
                                    @error('pincode') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Alamat Lengkap</label>
                                    <textarea wire:model.defer="address" id="address"  class="form-control shadow" rows="2"></textarea>
                                    @error('address') <small class="text-danger">{{$message}}</small> @enderror
                                </div>

                                <div class="shadow bg-white p-3">
                                    <h4 class="text-primary">
                                        Total Belanja :
                                        <span class="float-end">Rp.{{number_format($this->totalProductAmount)}}</span>
                                    </h4>
                                    <hr>
                                    <small>* Total belanja belum termasuk ongkir.</small>
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>Pilih Metode Pembayaran : </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery ( COD )</button>
                                            <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Transfer Bank</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>Cash on Delivery Mode</h6>
                                                <hr />
                                                <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary shadow">
                                                    <span wire:loading.remove wire:target="codOrder">
                                                        Lanjutkan ( COD )
                                                    </span>
                                                    <span wire:loading wire:target="codOrder">
                                                        Memproses...
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <!-- <button class="btn btn-primary col-md-12  shadow">Midtrans Transfer</button> -->
                                                <hr />
                                                <!-- <button id="tf" type="button" wire:loading.attr="disabled" class="btn btn-warning shadow">Bayar sekarang (Transfer bank)</button> -->
                                                <div>
                                                    <div id="paypal-button-container"></div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            @else
            <div class="card card-body shadow text-center p-md-5">
                <h4>Tidak Ada Produk Di Checkout</h4>
                <a href="{{url('category')}}" class="btn btn-warning shadow">Belanja Sekarang</a>
            </div>
            @endif

        </div>
    </div>
</div>

@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AYGd2HwyDi7nMrjNBkABR3AG-ZLc1_dQUcyxmpbUta83tsWv8JStjlPPfWzpbhp6vSaXrqvijM8GM8nW&currency=USD"></script>
<script>
    paypal.Buttons({
        onClick: function() {
            // Validasi Untuk Online Payment/transfer
            if (!document.getElementById('fullname').value
                || !document.getElementById('email').value
                || !document.getElementById('nik').value
                || !document.getElementById('Phone').value
                || !document.getElementById('pincode').value
                || !document.getElementById('address').value
            )
            {
                Livewire.emit('validationForAll');
                return false;
            }else{
                @this.set('fullname', document.getElementById('fullname').value);
                @this.set('email', document.getElementById('email').value);
                @this.set('nik', document.getElementById('nik').value);
                @this.set('Phone', document.getElementById('Phone').value);
                @this.set('pincode', document.getElementById('pincode').value);
                @this.set('address', document.getElementById('address').value);
            }
        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "{{$this->totalProductAmount}}" // Can also reference a variable or function
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                if(transaction.status == "COMPLETED"){
                    Livewire.emit('transactionEmit', transaction.id );
                }
                // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
               
            });
       }
    }).render('#paypal-button-container');
</script>
@endpush