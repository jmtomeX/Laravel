@extends('layouts.intranet')

@section('section_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="card-header">Insertar Gastos</h1>
            <form action="{{ route('expenditures.store') }}" method="POST">
                @csrf
                <div class="card-header">INSERTAR TIPO DE GASTO</div><br>
                <div class="row">
                    <div class="col">
                        <div class="col-6">
                            <label for="categoria_id" class="col-form-label">SELECIONAR CATEGORÍA</label>
                            <select name="categoria_id" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categoria_id" onchange="getTypes()">
                            <option selected>Seleccionar
                            @foreach ($categories as $cat)
                                <option value="{{$cat-> id}}">{{$cat-> description}}</option>
                                @endforeach
                            </select>
                            <label for="tipo_id" class="col-form-label">SELECIONAR TIPO</label>
                            <select name="tipo_id" id="tipo_id" class="custom-select mb-2 mr-sm-2 mb-sm-0" disabled>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        @php ($date_now = date('Y-m-d'))
                        <div class="col-12">
                            <div class="form-group">
                                <label for="titulo" class="col-form-label">TITULO TIPO DE GASTO</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">

                                <label for="fecha" class="col-form-label">FECHA DE PAGO</label>
                                <input id="fecha" name="fecha" type='date' class="form-control" value="{{$date_now}}" />

                                <label for="amount" class="col-form-label">CANTIDAD</label>
                                <input type="number" name="amount" class="form-control col-4" id="amount">
                            </div>


                            <button type="submit" class="btn btn-primary col-12">Añadir Gasto</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <div class="col-12">
                <h1>Gastos</h1>
            </div>
            <div class=zrow">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gasto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Tipo de gasto</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gastos as $gasto)
                        <tr>
                            @php($id_type = $gasto->id)
                            <th scope="row">{{$id_type}}</th>
                            <td>{{$gasto->description}}</td>
                            <td>{{$gasto->amount}}</td>
                            <td>{{$gasto->date}}</td>
                            <td>{{$gasto -> type()->first() -> description}}</td>
                            <td>
                                <form id="eliminar_{{$id_type}}" method="post" action="{{url('expenditures')}}/{{$id_type}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <a href="#" onclick="if (confirm('¿Estás seguro que deseas eliminar el  gasto?')) document.forms['eliminar_{{$id_type}}'].submit();"><i class="fas fa-dumpster-fire"></i></a>
                            </td>
                            <!-- <td><a href="{{url('expenditures')}}/{{$id_type}}"><i class="fas fa-pencil-alt"></i></a></td> -->
                            <td><a href="#"><i class="fas fa-pencil-alt"></i></a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getTypes() {
        var categoria_id = $("#categoria_id").val();
        var tipo_id = $("#tipo_id");

        $.ajax({
            type: "GET",
            url: "{{ url('expenditures/types') }}/" + categoria_id,
            dataType: 'json',
            success: function(data) {
                //Por si hiciera falta:
                //var obj = JSON.parse(data); 
                console.log(data);
                console.log(data.res);
                if (data.res >= 0) {
                    tipo_id.empty();
                    tipo_id.removeAttr('disabled');
                    data.datos.forEach(element => {
                        tipo_id.append("<option value='" + element.id + "'>" + element.description);
                        console.log(element.description);
                    });

                } else {
                    alert("No se han podido cargar los datos")
                }
            },
            error: function(data) {
                alert(" Error");
            }
        });
        /*
                var $tipo = $("#tipo_id");


                $(document).on('change', '#tipo_id', function(event) {
                    alert($("#tipo_id").val());
                });
        */
    }
</script>
@endsection