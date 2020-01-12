@extends('layouts.intranet')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('productos.update',['id'=>$prs->id])}}" method="POST">
                @csrf
                <div class="card-header">Actualizar PRODUCTO</div><br>
                <div class="form-group">
                    <label for="producto">Nombre</label>
                    <input type="text" name="producto" class="form-control" id="producto" aria-describedby="emailHelp"
                        placeholder="Nombre producto" value="{{$prs->producto}}">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{$prs->descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" class="form-control" id="precio" aria-describedby="emailHelp"
                    value="{{$prs->precio}}" >
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</div>

@endsection