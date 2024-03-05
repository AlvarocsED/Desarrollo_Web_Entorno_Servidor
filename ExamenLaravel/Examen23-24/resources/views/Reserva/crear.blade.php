<h1 class="text-center">CREAR RESERVA</h1>
@section('contenido')
    <form action="{{route('reserva/crearReserva')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Viaje</label>
            <input type="text" class="form-control" 
            name="nombre" id="nombre" placeholder="Nombre" value="{{old('tituloViaje')}}">
            @error('tituloViaje')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Fecha</label>
            <input type="text" class="form-control" name="desc" id="desc" 
            placeholder="Descripción" value="{{old('fSalida')}}">
            @error('fSalida')
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Nº Personas</label>
            <input type="number" class="form-control" name="precio" 
            id="precio" step="0.01" value="{{old('nPersonas')}}">
        </div>
            @error('nPersonas')            
                <span class="text-danger">{{$message}}</span>
            @enderror
        <div class="mb-3">
            <label for="stock" class="form-label">Precio por Persona</label>
            <input type="number" class="form-control" name="stock" 
            id="stock" value="{{old('precioP')}}">
            @error('precioP')            
             <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Crear</button>
            <a href="{{route('reserva')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection
