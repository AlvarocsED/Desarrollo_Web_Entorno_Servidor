@extends('plantilla/plantilla')

@section('titulo','CLIENTES')


@section('contenido')
    
    {{--  <a class="btn btn-outline-success" href="{{route('crearCita')}}">Nueva cita</a> --}}

    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Puntos</th>
                <th scope="col">Proxima cita</th>
            </tr>
        </thead>
        <tbody>
</table>