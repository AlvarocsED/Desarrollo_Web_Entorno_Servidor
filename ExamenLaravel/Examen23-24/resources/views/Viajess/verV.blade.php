@section('contenido')
    <a class="btn btn-outline-success" href="{{route('crearViaje')}}">Crear viaje</a>

    <table class="table table-striped">
        <thead class="table-info">
            <tr>
                <th scope="col">Id</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($Viajes as $v)
                <tr>
                    <td>{{$v->id}}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
