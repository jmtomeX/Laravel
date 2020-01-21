@extends('layouts.intranet')

@section('section_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Estadisticas</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h1>Total gastos {{$total}}</h1>
                    @foreach($totalCats as $totalCat)
                    Categoria: {{$totalCat->description}} - Total: {{$totalCat->total}} <br>
                    @endforeach
                    You are logged in!
                    <p>Role User: @if (Auth::user()->hasRole('admin')) Yes @else No @endif</p>
                    <p>Role User: @if (Auth::user()->hasRole('user')) Yes @else No @endif</p>
                </div>
            </div>
            @isset($donut)
            <div id="chart-div"></div>
            {!!$donut->render('DonutChart', 'IMDB', 'chart-div') !!}
            @endisset
            @isset($lava)
            <div id="pop_div"></div>
            {!!$lava->render('AreaChart', 'Population', 'pop_div')!!}
            @endisset


        </div>
    </div>
    <form action="{{ route('expenditures.graphic') }}" method="POST">
        @csrf
        @php ($date_now = date('Y-m-d'))
        <div class="form-group">
            <label for="categoria_id" class="col-form-label">SELECIONAR CATEGORÍA</label>
            <select name="categoria_id" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categoria_id">
                <option selected>Seleccionar

            </select>
            <div class="form-group">
                <label for="tipo_id" class="col-form-label">SELECIONAR TIPO</label>
                <select name="tipo_id" id="tipo_id" class="custom-select mb-2 mr-sm-2 mb-sm-0" disabled>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha" class="col-form-label">Desde</label>
                <input id="fecha" name="fecha" type='date' class="form-control" value="{{$date_now}}" />
            </div>
            <div class="form-group">
                <label for="fecha" class="col-form-label">Hasta</label>
                <input id="fecha" name="fecha" type='date' class="form-control" value="{{$date_now}}" />
            </div>

            <button type="submit" class="btn btn-primary">Mostrar Gráfica</button>
        </div>
    </form>
</div>
@endsection