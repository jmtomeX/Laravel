@extends('layouts.intranet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>

            <!-- Mostramos los productos desde HomeController.php  -->
            <div class="row">
                <div class="col-12">
                <h1 class="display-4">Opiniones del producto {{$product->producto}} (Precio:{{$product->precio}})</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TITULO</th>
                            <th scope="col">OPINION</th>
                            <th scope="col">VALORACION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->opinions()->get() as $opinion)
                        <tr>
                            <td>{{ $opinion->id}}</td>
                            <td>{{ $opinion->titulo}}</td>
                            <td>{{ $opinion->comentario}}</td>
                            <td>{{ $opinion->valor}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection