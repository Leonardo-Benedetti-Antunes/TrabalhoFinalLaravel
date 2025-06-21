@extends('layouts.default')

@section('content')

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded">
        <h1 class="text-2xl font-bold text-center text-indigo-600 mb-6">Pagamento via Pix</h1>

        <div class="flex flex-col items-center gap-6">
            <img src="{{ asset('images/qrcode.png') }}" alt="QR Code Pix" class="w-48 h-48 object-contain">

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                    Confirmar Pagamento
                </button>
            </form>
        </div>
    </div>

@endsection