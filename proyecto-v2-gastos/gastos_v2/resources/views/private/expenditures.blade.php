@extends('layouts.intranet')

@section('section_content')
<div class="container-fluid p-5">
    <div class="row justify-content-center">
        @isset($res)
        @if($res > 0)
        <div class="card bg-success col-12">
            <div class="card-header">
                <h3 class="card-title">Aviso</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                Archivo subido con exito! <i class="nav-icon far fa-file-excel"></i>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        @elseif ($res < 0) <div class="info-box bg-danger">
            <div class="info-box-content">
                <span class="info-box-text">Error</span>
                <span class="progress-description">
                    El archivo no se ha procesado!, comprueba que sea formato .xlsx <i
                        class="nav-icon far fa-file-excel"></i> y que tenga limpio los campos vacios. <br>
                    Copia las tablas y crea un archivo nuevo limpio, si el error persiste.
                </span>
            </div>
            <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    @endif
    @endisset
    <button class="btn btn-primary col-12" id="form-target">Mostrar Formulario</button>
    <div class="col" id="show-form">
        <h1 class="card-header">Insertar Gastos</h1>
        <form action="{{ route('expenditures.store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="card-header">INSERTAR TIPO DE GASTO</div><br>
            <div class="row">
                <div class="col">
                    <div class="col-6">
                        <label for="categoria_id" class="col-form-label">SELECIONAR CATEGORÍA</label>
                        <select name="categoria_id" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categoria_id"
                            onchange="getTypes()">
                            <option selected>Seleccionar
                                @foreach ($categories as $cat)
                            <option value="{{$cat-> id}}">{{$cat-> category}}</option>
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
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="your_file" name="your_file"
                                    aria-describedby="inputGroupFileAddon01" lang="es">
                                <label class="custom-file-label" id="text_file" for="your_file">Seleccionar
                                    archivo para subir</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-12">Añadir Gasto</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col p-5">

        <table id="dataTable" style="width:100%" class="table table-striped table-bordered dt-responsive nowrap">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gasto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tipo de gasto</th>
                    <th scope="col">Archivos</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gastos as $gasto)
                <!-- Buscamos la imagen y sacamos la ruta  -->
                @php ($img_url='')
                @isset($gasto->file)
                @php ($img_url=$gasto->file)
                @if (strpos($gasto->file, 'http') === false)
                @php ($img_url=asset('img_uploads')."/".$gasto->file)
                @endif
                @endisset
                <tr>
                    @php($id = $gasto->exp_id)
                    <th scope="row">{{$id}}</th>
                    <td>{{$gasto->description}}</td>
                    <td>{{$gasto->amount}}</td>
                    <td>{{$gasto->date}}</td>
                    <td>{{$gasto -> type()->first() -> type}}</td>
                    <td><img src="{{$img_url}}" alt="" width="250" ></td>
                    <td>
                        <form id="eliminar_{{$id}}" method="post" action="{{route('expenditures.destroy',['expenditure'=>$id])}}">
                            @csrf
                            <input type="hidden" name="_method" value="delete" />
                            <a href="#"
                                onclick="if (confirm('¿Estás seguro que deseas eliminar el  gasto?')) document.forms['eliminar_{{$id}}'].submit();"><i
                                    class="fas fa-dumpster-fire"></i></a>
                        </form>
                    </td>
                    <!-- <td><a href="{{url('expenditures')}}/{{$id}}"><i class="fas fa-pencil-alt"></i></a></td> -->
                    <td><a href="#"><i class="fas fa-pencil-alt"></i></a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection

@section('js_custom')
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#show-form').hide();
    $("#form-target").on("click", function() {
        $('#show-form').toggle("slow");
    });


    $('#dataTable').DataTable({
        "order": [
            [3, "desc"]
        ],
        "columnDefs": [{
            "targets": [4, 5, 6],
            "orderable": false
        }],
        //"lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        //"pageLength": 4
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});

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
                    tipo_id.append("<option value='" + element.id + "'>" + element.type);
                    console.log(element.type);
                });

            } else {
                alert("No se han podido cargar los datos")
            }
        },
        error: function(data) {
            alert(" Error");
        }
    });

}

$('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $(this).next('#text_file').html(fileName);
})
</script>
@endsection