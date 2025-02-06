@extends('layouts.app')

@section('title', 'Producto - ' . $product->name)

@section('content')
    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img
                    src="{{ $product->image_url }}"
                    class="img-fluid rounded-start"
                    alt="{{ $product->name }}"
                />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p class="card-text">{!! $product->description !!}</p>
                </div>
            </div>
        </div>
    </div>

    <h4>Precios por Proveedor</h4>
    @if($product->providers->isEmpty())
        <div class="alert alert-warning" role="alert">
            No hay precios disponibles para este producto.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($product->providers as $provider)
                <div class="col">
                    <div class="card h-100 text-center {{ $provider->id === $product->bestPrice()->id ? 'border-5 border-primary' : '' }}">
                        <img
                            src="{{ $provider->provider->logo_url }}"
                            class="card-img-top p-4"
                            alt="{{ $provider->provider->name }} Logo"
                            style="max-height: 100px; object-fit: contain;"
                        />

                        <div class="card-body">
                            <h5 class="card-title">{{ $provider->provider->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Última actualización: {{ $provider->last_checked_at->diffForHumans() }}
                            </h6>

                            <p class="card-text text-muted">Precio actual</p>

                            <h3 class="text-primary">
                                {{ $provider->priceFormatted() }}
                            </h3>
                        </div>

                        <div class="card-footer">
                            <a
                                href="{{ $provider->url }}"
                                target="_blank"
                                class="btn btn-outline-primary w-100"
                            >
                                Ver en {{ $provider->provider->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
