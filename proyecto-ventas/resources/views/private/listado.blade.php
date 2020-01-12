@extends('layouts.intranet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('productos.insertar') }}" enctype='multipart/form-data' method="POST">
                @csrf
                <div class="card-header">INSERTAR PRODUCTO</div><br>
                <div class="form-group">
                    <label for="producto">Nombre</label>
                    <input type="text" name="producto" class="form-control" id="producto" aria-describedby="emailHelp"
                        placeholder="Nombre producto">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>
                <div class="file-path-wrapper">
                    <input type="file" class="file-path validate" id="image" name="image" ></input>
                </div>
                <br>
                <div class="form-group">
                    <select id="category_id" name="category_id" class="form-control">
                        <option disabled selected>Seleccionar Categoría</option>
                        @foreach($cat as $category)
                             <option value="{{$category->id}}">{{$category->titulo}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" class="form-control" id="precio" aria-describedby="emailHelp"
                        placeholder="Nombre producto">
                </div>

                <button type="submit" class="btn btn-primary">Añadir</button>
            </form>
            <br>

            <!-- Mostramos los productos desde HomeController.php  -->
            <div class="row">
                <div class="col-12">LISTADO</div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">CATEGORIA</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">OPINIONES</th>
                            <th scope="col">VALORACIÓN</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prs as $pr)
                        @php ($img_url='')
                        @isset($pr->image)
                            @php ($img_url=$pr->image)
                            @if (strpos($pr->image, 'http') === false)
                                @php ($img_url=asset('img_uploads')."/".$pr->image)
                            @endif
                        @endisset
                        @php ($opinion_count = $pr->opinions()->count())
                        @php ($opinion_avg = $pr->opinions()->avg('valor'))
                        @php ($opiniones="")
                            @foreach ($pr->opinions()->get() as $opinion)
                            @php ($opiniones.=$opinion->titulo)
                            @endforeach
                        <tr>
                            @php ($pr_id = $pr->id)
                            <th scope="row" title="{{$opiniones}}">{{$pr_id}}</th>
                            <td>{{$pr->producto}}</td>
                            <td>{{$pr->category() -> first() ->titulo}}</td>
                            @php ($txt = $pr->descripcion)
                            @php($str = (substr($txt, 0, 100)))
                            <td>{{$str.'...'}}</td>

                            @if ($opinion_count == 0)
                            <td>{{$opinion_count}}</td>
                            @else 
                            <td><a href="{{url('productos/opiniones')}}/{{$pr_id}}">{{$opinion_count}}</a></td>
                            @endif
                            <td>{{number_format($opinion_avg,0)}}</td>
                            <td>{{$img_url}}</td>
                            <td><img src="{{$img_url}}" alt="" width="250" ></td>
                            <td>{{$pr->precio}}</td>
                            <td><a href="{{url('productos/eliminar')}}/{{$pr_id}}"
                                    onclick="return confirm('¿Estás seguro que deseas eliminar el producto?');"><i
                                        class="fas fa-dumpster-fire"></i></a></td>
                            <!-- <td><a href="{{route('productos.eliminar',['id'=>$pr_id])}}" onclick="return confirm('¿Estás seguro que deseas eliminar el producto?');"><i class="fas fa-dumpster-fire"></i></a></!-->
                            <td><a href="{{url('productos/get')}}/{{$pr_id}}"><i class="fas fa-pencil-alt"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Mostrar navegación -->
                {{ $prs->links() }}
            </div>
        </div>
    </div>
</div>

@endsection