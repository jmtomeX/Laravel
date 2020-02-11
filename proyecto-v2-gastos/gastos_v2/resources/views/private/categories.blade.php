@extends('layouts.intranet')

@section('section_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @php ($user_id = auth()->id())
        @if (isset($cat_edit))
            <form action="{{ route('categories.update',['category' => $cat_edit->category]) }}" method="POST">
                @csrf
                <input type="hidden"  name="_method" value="PUT"/>
                <input type="hidden"  name="user_id" value="{{$user_id}}"/>
                <div class="card-header">INSERTAR CATEGORIA</div><br>
                <div class="form-group">
                    <label for="titulo" class="col-form-label">TTITULO CATEGORIA</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{$cat_edit->category}}" required>
                </div>              
          
                <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
                <a href="{{route('categories.index')}}" class="btn btn-secondary">Nueva Categoría</a>
            </form>
        @else
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <input type="hidden"  name="user_id" value="{{$user_id}}"/>
                <div class="card-header">INSERTAR CATEGORIA</div><br>
                <div class="form-group">
                    <label for="titulo" class="col-form-label">TTITULO CATEGORIA</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>              
          
                <button type="submit" class="btn btn-primary">Añadir Categoría</button>
                
            </form>
        @endif
        
            
            <br>

            <!-- Mostramos las opiniones desde OpinionController.php  -->
            <div class="row">
                <div class="col-12">
                    <h1>CATEGORIAS</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Categoria</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat as $categoria)
                        <tr>
                            @php($id_cat = $categoria->id)
                            <th scope="row">{{$id_cat}}</th>
                            <td>{{$categoria->category}}</td>
                           
                            <td>
                                <form id="eliminar_{{$id_cat}}" method="post" action="{{url('categories')}}/{{$id_cat}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <a href="#"
                                        onclick="if (confirm('¿Estás seguro que deseas eliminar la categoria?')) document.forms['eliminar_{{$id_cat}}'].submit();"><i
                                            class="fas fa-dumpster-fire"></i></a></form>
                            </td>
                            <!-- Con URL -->
                             <td><a href="{{url('categories')}}/{{$id_cat}}/edit"><i class="fas fa-pencil-alt"></i></a></td>
                             <!-- Con ruta -->
                             <!-- <td><a href="{{route('categories.edit',['category' => $id_cat])}}"><i class="fas fa-pencil-alt"></i></a></td> -->
                             <!-- <td><a href="#"><i class="fas fa-pencil-alt"></i></a></td> -->

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection