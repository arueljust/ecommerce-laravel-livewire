@extends('layouts.app')

@section('title','Thank You for Shopping')

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if(session('message'))
                <h5 class="alert alert-success">{{session('message')}}</h5>
                @endif
                <div class="p-4 shadow bg-white">
                    <h2>My Logo</h2>
                    <h4>Terima Kasih Telah Berbelanja Di Zatoku</h4>
                    <h6 class="">Dapatkan Penawaran Menarik Lainnya</h6>
                    <a href="{{url('category')}}" class="btn btn-sm btn-primary shadow">Belanja Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
