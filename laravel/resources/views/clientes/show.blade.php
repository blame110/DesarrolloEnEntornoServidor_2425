@extends('layout.app')

@section('content')
<div class="container">
    <h1>Detalles del Cliente</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $cliente->nombre }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $cliente->email }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>

            <!-- Mostrar la imagen del cliente -->
            @if ($cliente->imagen)
                <img src="{{ asset('storage/' . $cliente->imagen) }}" alt="Imagen de {{ $cliente->nombre }}" class="img-fluid rounded" style="max-width: 200px;">
            @else
                <p>No hay imagen disponible.</p>
            @endif

            <hr>

            <!-- Listado de mascotas -->
            <h4>Mascotas de {{ $cliente->nombre }}</h4>
            @if ($cliente->mascotas->isEmpty())
                <p>{{ $cliente->nombre }} no tiene mascotas registradas.</p>
            @else
                <ul>
                    @foreach ($cliente->mascotas as $mascota)
                        <li>{{ $mascota->nombre }} - {{ $mascota->especie }} ({{ $mascota->edad }} años)</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</div>
@endsection

