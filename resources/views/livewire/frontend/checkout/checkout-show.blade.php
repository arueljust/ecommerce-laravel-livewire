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
                                    <input type="text" wire:model.defer="fullname" class="form-control shadow" placeholder="Masukkan nama lengkap" />
                                    @error('fullname') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" wire:model.defer="email" class="form-control shadow" placeholder="Masukkan alamat email @ .com/id" />
                                    @error('email') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>NIK</label>
                                    <input type="text" wire:model.defer="nik" class="form-control shadow" placeholder="Masukkan NIK 16 digit" />
                                    @error('nik') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>No Telp (Whatsapp)</label>
                                    <input type="number" wire:model.defer="Phone" class="form-control shadow" placeholder="Masukkan nomor " />
                                    @error('Phone') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Kode Pos</label>
                                    <input type="number" wire:model.defer="pincode" class="form-control shadow" placeholder="Masukkan kode pos" />
                                    @error('pincode') <small class="text-danger">{{$message}}</small> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="provinsi">Provinsi</label>
                                    <select name="provinsi" wire:model="provinsi_id" class="form-control shadow" required>
                                        <option value="0"> - Pilih Provinsi Asal - </option>
                                        @forelse($daftarProvinsi as $provinsi)
                                        <option value="{{$provinsi['province_id']}}">{{$provinsi['province']}}</option>
                                        @empty
                                        <option value="0"> Provinsi tidak ditemukan </option>
                                        @endforelse
                                    </select>
                                    @error('provinsi') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kota"> Kota </label>
                                    <select name="kota" wire:model="kota_id" class="form-control shadow"required>
                                        <option value="0"> - Pilih Kabupaten / Kota Asal - </option>
                                        @if($provinsi_id)
                                        @forelse($daftarKota as $kota)
                                        <option value="{{$kota['city_id']}}">{{$kota['city_name']}}</option>
                                        @empty
                                        <option value="0"> Kabupaten / Kota tidak ditemukan </option>
                                        @endforelse
                                        @endif
                                    </select>
                                    @error('provinsi') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jasa">Jasa Pengiriman</label>
                                    <select name="jasa" wire:model="jasa" class="form-control shadow"required>

                                        <option value=""> - Pilih Jasa Pengiriman - </option>
                                        <option value="jne"> JNE </option>
                                        <option value="pos"> Pos Indonesia (POS) </option>
                                        <option value="tiki"> TIKI </option>

                                    </select>
                                    @error('provinsi') <small class="text-danger">{{$message}}</small> @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Alamat Lengkap</label>
                                    <textarea wire:model.defer="address" class="form-control shadow" rows="2"></textarea>
                                    @error('address') <small class="text-danger">{{$message}}</small> @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-sm  text-white btn-primary shadow"> Cek Ongkir </button>
                                </div>

                                @if($result)
                                <section class="col md-12 mb-5">
                                    <div class="row mt-4">

                                        @foreach ($result as $r)
                                        <div class="col-md-3">
                                            <div class="card shadow">
                                                <div class="card-body text-center">
                                                    <div>
                                                        <h5>{{$nama_jasa}}</h5>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <h5> <strong>Rp. {{ number_format($r ['cost']) }}</strong> </h5>
                                                            <h6> <strong>{{ $r [ 'etd' ] }} Hari </strong> </h6>
                                                            <h6> <strong>{{ $r ['description'] }}</strong> </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 shadow">
                                                        <button class="btn btn-sm btn-block btn-primary" wire:click="save_ongkir({{ $r ['cost'] }})">
                                                            Tambah ongkir
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                </section>
                                @endif

                                <div class="shadow bg-white p-3">
                                    <h4 class="text-primary">
                                        Total Belanja :
                                        <span class="float-end">Rp.{{number_format($this->totalProductAmount)}}</span>
                                    </h4>
                                    <hr>
                                    <small>* Total belanja sudah termasuk ongkir.</small>
                                </div>
                                <div class="col-md-12 mb-3">
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
                                                <h6>Transfer bank Mode</h6>
                                                <hr />
                                                <button type="button" wire:loading.attr="disabled" class="btn btn-warning shadow">Bayar sekarang (Transfer bank)</button>
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