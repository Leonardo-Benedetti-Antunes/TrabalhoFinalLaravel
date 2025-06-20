@extends('layouts.default')

@section('content')

<section class="text-gray-600">
    <div class="container px-5 py-24 mx-auto">
        <div class="container px-5 py-24 mx-auto">

            <form method="GET" action="{{ route('home') }}" class="mb-8 flex flex-wrap gap-4 items-center justify-center">
                <input type="number" name="min_price" placeholder="Preço mínimo" value="{{ request('min_price') }}"
                class="border border-gray-300 rounded px-4 py-2">
                <input type="number" name="max_price" placeholder="Preço máximo" value="{{ request('max_price') }}"
                class="border border-gray-300 rounded px-4 py-2">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Filtrar
                </button>
            </form>

            @php
                $columns = $products->chunk(4); 
            @endphp

           <div class="flex flex-wrap -m-4">
            @foreach ($columns as $chunk)
                <div class="w-full md:w-1/2 flex flex-col gap-6 p-2">
                    @foreach ($chunk as $p)
                        <div class="border rounded p-4">
                                <a class="block relative h-48 rounded overflow-hidden">
                                    <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="{{ $p->cover }}">
                                </a>
                                <div class="mt-4">
                                <h2 class="text-gray-900 title-font text-lg font-medium">{{ $p->name }}</h2>
                                <p class="mt-1">R$ {{ number_format($p->price, 2, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('product', $p->slug) }}" class="mt-3 text-indigo-500 inline-flex items-center">
                                Ver mais
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        <div class="mt-10">
            {{ $products->links() }}
        </div>

    </div>
</section>

@endsection