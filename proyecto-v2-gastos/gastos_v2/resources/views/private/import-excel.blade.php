@extends('layouts.intranet')

@section('section_content')
<div class="container-fluid p-5">
    <div class="row justify-content-center">
        <div class="col">
            <h1>Importar Excel</h1>
            <form action="{{ route('import.excel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
                @endif
                <div class="row">
                    <div class="col">
                            <div class="col-6">
                                <label for="categoria_id" class="col-form-label">SELECIONAR CATEGORÍA</label>
                                <select name="categoria_id" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categoria_id">
                                    <option selected>Seleccionar
                                    <option value="">Culaquiera</option>
                                </select>
                            </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="file_excel" name="file_excel">Subir Archivo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="es">
                                    <label class="custom-file-label" for="inputGroupFile01">Seleccionar Archivo</label>
                                </div>
                            </div>
                        </div>

            </form>
        </div>
    </div>
    @endsection