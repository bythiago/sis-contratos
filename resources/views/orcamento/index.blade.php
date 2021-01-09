@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<form id="formulario-lista" method="POST" role="form" action="{{ route('orcamentos.store') }}" novalidate>
    <div id="app" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="" class="btn btn-success">Salvar</a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/orcamento/index.js') }}"></script>
@stop