@extends('plantilla/plantilla')

@section('titulo','CREAR PRODUCTOS')

@section('contenido')
    <form action="{{route('crearCita')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">NombreCliente</label>
            <input type="text" class="form-control" 
            name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre')}}">
            @error('nombre')            
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Servicio</label>
            <input type="text" class="form-control" name="servicio" id="servicio" 
            placeholder="Servicio" value="{{old('servicio')}}">
            @error('servicio')            
                <span class="text-danger">Debes rellenar el servicio</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" name="importe" 
            id="importe" step="0.01" value="{{old('importe')}}">
        </div>
            @error('precio')            
                <span class="text-danger">{{$message}}</span>
            @enderror
        <div class="mb-3">
            <label for="stock" class="form-label">Pagado</label>
            <input type="number" class="form-control" name="pagado" 
            id="pagado" value="{{old('pagado')}}">
            @error('pagado')            
             <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-outline-success">Crear</button>
            <a href="{{route('verClientes')}}" class="btn btn-outline-success">Cancelar</a>
        </div>
    </form>
@endsection
