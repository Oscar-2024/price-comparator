@extends('layouts.app')

@section('content')
    <h1 class="my-4">Lista de Productos</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img
                        src="{{ $product->image_url }}"
                        class="card-img-top" alt="{{ $product->name }}"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <a
                            href="{{ route('products.price-comparator', $product->id) }}"
                            class="btn btn-primary"
                        >
                            Comparar Precios
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
