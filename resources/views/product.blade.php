@extends('layouts.default')

@section('content')

    <section class="text-gray-600 overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    src="{{ Storage::url($product->cover) }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                    <p class="leading-relaxed">{{ $product->description }}</p>
                    <div class="my-3">
                        @if ($product->stock < 2)
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-200 text-indigo-800">Em
                                estoque {{ $product->stock }} </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">Em
                                estoque {{ $product->stock }} </span>
                        @endif
                    </div>
                    <div class="flex border-t-2 border-gray-100 mt-6 pt-6">
                        <span class="title-font font-medium text-2xl text-gray-900">R$: {{ $product->price }}</span>
                        <div class="flex ml-auto text-white">
                            @if ($product->stock > 0)
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                        class="bg-indigo-500 border-0 py-2 px-6 ml-5 focus:outline-none hover:bg-indigo-600 rounded">
                                        Adicionar ao carrinho
                                    </button>
                                </form>
                            @else
                                <span class="text-red-500 font-semibold ml-5">Produto indisponível</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection