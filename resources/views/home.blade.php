@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
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
                    <table id="cliente-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Sexo</th>
                                <th>Cidade</th>
                                <th>Bairro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados['cliente'] as $cliente)
                                <tr>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->cpf }}</td>
                                    <td>{{ $cliente->sexo }}</td>
                                    <td>{{ $cliente->cidade }}</td>
                                    <td>{{ $cliente->bairro }}</td>
                                    <td data-id="{{ $cliente->id }}">
                                        <button class="btn btn-info btn-sm actions">
                                            <i class="far fa-search"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="far fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('js/cliente/lista.js') }}"></script>
@stop