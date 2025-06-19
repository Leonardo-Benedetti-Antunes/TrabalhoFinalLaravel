@extends('layouts.default')

@section('content')

    <div class="bg-gray-200 text-center py-2">
        <h1 class="font-bold font-size-16px text-xl"> Seu carrinho</h1>
    </div>
    @foreach ($items as $item)
        <div class="flex justify-between items-center px-20 py-5">
            <div class="px-4 py-3">
                <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                    src="{{ Storage::url($item->product->cover)}}">
            </div>
            <p>{{ $item->product->name }}</p>
            <p>{{ $item->product->price }}</p>
        </div>
    @endforeach

@endsection