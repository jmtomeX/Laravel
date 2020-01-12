@extends('layouts.intranet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>

            <!-- Mostramos los productos desde HomeController.php  -->
            <div class="row">
                <div class="col-12">Opiniones del producto {{$op_product[0]->product()->first()->producto}} (Precio:{{$op_product[0]->product()->first()->precio}})</div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TITULO</th>
                            <th scope="col">OPINION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($op_product as $opinion)
                        <tr>
                            <td>{{ $opinion->id}}</td>
                            <td>{{ $opinion->titulo}}</td>
                            <td>{{ $opinion->comentario}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection