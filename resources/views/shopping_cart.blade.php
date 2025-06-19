@extends('layouts.default')

@section('content')

    <div class="bg-gray-200 text-center py-4">
        <h1 class="font-bold text-2xl">Seu Carrinho</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-20 mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($items->isEmpty())
        <div class="text-center text-gray-600 py-10">
            <p>Seu carrinho está vazio.</p>
        </div>
    @else
        <div class="px-20 py-6 space-y-6">
            @foreach ($items as $item)
                <div class="flex items-center justify-between bg-white shadow rounded p-4">
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 flex-shrink-0">
                            <img src="{{ Storage::url($item->product->cover) }}" alt="{{ $item->product->name }}"
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">{{ $item->product->name }}</h2>
                            <p class="text-gray-600">Quantidade: {{ $item->quantity }}</p>
                            <p class="text-gray-800 font-medium">Preço unitário: R$
                                {{ number_format($item->product->price, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="text-xl font-semibold">
                            Subtotal: R$ {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}
                        </p>

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                Remover
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="text-right border-t pt-4 mt-6">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <p class="text-2xl font-bold mb-4">
                        Total: R$
                        {{ number_format($items->sum(fn($item) => $item->product->price * $item->quantity), 2, ',', '.') }}
                    </p>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded">
                        Finalizar Compra
                    </button>
                </form>
            </div>
        </div>
    @endif

@endsection