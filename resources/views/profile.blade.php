@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-5 col-12 mb-3">
                <img src="{{ asset('img/visi-misi.svg') }}" class="img-fluid">
            </div>
            <div class="col-md-7 col-12 mb-3 align-self-center d-flex flex-column gap-4">
                <div class="">
                    <h1 class="display-4 fw-semibold">Visi</h1>
                    <h5 class="text-black-50">
                        Menjadi UMKM terbaik yang bergerak dalam menyediakan produk kerajinan lokal
                    </h5>
                </div>
                <div class="">
                    <h1 class="display-4 fw-semibold">Misi</h1>
                    <h5 class="text-black-50">
                        Menciptakan berbagai produk kerajian lokal unik serta berkualitas untuk memberikan hasil kerajinan
                        terbaik
                    </h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <img src="{{ asset('img/bagan.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.120518540583!2d98.70365221373571!3d3.5597072514866674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303131228a54ec9d%3A0x5c5bb112ee0f7105!2sDilla%20Handycraft!5e0!3m2!1sen!2sid!4v1661311838559!5m2!1sen!2sid"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
