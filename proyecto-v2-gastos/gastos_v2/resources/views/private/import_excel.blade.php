@extends('layouts.intranet')

<!-- @section('css_custom')
<style>
body form div .custom-file input .custom-file-input:after {
    content: "Buscar";
}
</style>
@endsection -->
@section('section_content')
<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col">
            <h1>Importar Excel</h1>
            <form action="{{ route('import.excel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="file_excel" name="file_excel">Subir
                                            Archivo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="your_file" name="your_file"
                                            aria-describedby="inputGroupFileAddon01" lang="es">
                                        <label class="custom-file-label" id="text_file"
                                            for="inputGroupFile01">Seleccionar Archivo</label>
                                    </div>
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-warning col-12">Enviar archivo</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
    @endsection
    @section('js_custom')
    <script>
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $(this).next('#text_file').html(fileName);
    })
    </script>

    @endsection