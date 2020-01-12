@extends('layouts.intranet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('opiniones.store') }}" method="POST">
                @csrf
                <div class="card-header">INSERTAR OPINION</div><br>
                <div class="form-group">
                    <label for="titulo" class="col-form-label">TTITULO</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Comentario</label>
                    <textarea class="form-control" id="messagetext" name="messagetext"></textarea>
                </div>
                <div class="form-group">
                    <label for="valor" class="col-form-label">Puntuación</label>
                    <input type="number" min="0" max="5" class="form-control" id="valor" name="valor"></input>
                    <input type="text" id="id_prod" name="id_prod" value="" hidden></input>
                </div>
                <div class="form-group">
                    <select id="producto_id" name="producto_id" class="form-control">
                        <option disabled selected>Seleccionar Producto</option>
                        @foreach($prs as $product)
                             <option value="{{$product->id}}">{{$product->producto}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Añadir Opinion</button>
            </form>
            <br>

            <!-- Mostramos las opiniones desde OpinionController.php  -->
            <div class="row">
                <div class="col-12">
                    <h1>OPINIONES</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TTITULO</th>
                            <th scope="col">COMENTARIO</th>
                            <th scope="col">VALORACIÓN</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opn as $opinion)
                        <tr>
                            @php($id_opi = $opinion->id)
                            <th scope="row">{{$id_opi}}</th>
                            <td>{{$opinion->titulo}}</td>
                            <td>{{$opinion->comentario}}</td>
                            <td>{{$opinion->valor}}</td>
                            <td>{{$opinion->product()->first()->producto}}</td>
                            <td>
                                <form id="eliminar_{{$id_opi}}" method="post" action="{{url('opiniones')}}/{{$id_opi}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <a href="#"
                                        onclick="if (confirm('¿Estás seguro que deseas eliminar la opinion?')) document.forms['eliminar_{{$id_opi}}'].submit();"><i
                                            class="fas fa-dumpster-fire"></i></a></form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Mostrar navegación -->
                {{$opn->links()}}
            </div>
        </div>
    </div>
</div>

@endsection