@extends('layouts.intranet')

@section('section_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @php ($user_id = auth()->id())
            <form action="{{ route('types.store') }}" method="POST">
                @csrf
                <div class="card-header">INSERTAR TIPO DE GASTO</div><br>
                <label for="categorias" class="col-form-label">SELECIONAR CATEGORÍA</label>
                <select name="categoria_id" class="form-control" id="exampleFormControlSelect1">
                @foreach ($categories as $cat)
                <option value="{{$cat-> id}}">{{$cat-> category}}</option>
                @endforeach
                </select>
          
           
                <div class="form-group">
                    <label for="titulo" class="col-form-label">TTITULO TIPO DE GASTO</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                </div>

                <button type="submit" class="btn btn-primary">Añadir Tipo</button>
            </form>
            <br>

            <!-- Mostramos las opiniones desde CategorieController.php  -->
            <div class="row">
                <div class="col-12">
                    <h1>Tipos de gastos</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo de gasto</th>
                            <th scope="col">Categoria</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $tipo)
                        <tr>
                            @php($id_type = $tipo->ID)
                            <th scope="row">{{$id_type}}</th>
                            <td>{{$tipo->DESCRIPTION}}</td>
                            <td>{{$tipo -> category() -> first() -> category}}</td>
                            <td>
                                <form id="eliminar_{{$id_type}}" method="post" action="{{url('types')}}/{{$id_type}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <a href="#"
                                        onclick="if (confirm('¿Estás seguro que deseas eliminar el tipo de gasto?')) document.forms['eliminar_{{$id_type}}'].submit();"><i
                                            class="fas fa-dumpster-fire"></i></a></form>
                            </td>
                            <!-- <td><a href="{{url('types')}}/{{$id_type}}"><i class="fas fa-pencil-alt"></i></a></td> -->
                            <td><a href="#"><i class="fas fa-pencil-alt"></i></a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection