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
                    <table id="pedido-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>@</th>
                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados['pedidos'] as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->cliente->nome }}</td>
                                    <td>{{ $pedido->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $pedido->status->descricao }}</td>
                                    <td>
                                        @if ($pedido->anotacao)
                                            <a style="cursor: help;" class="fas fa-info-circle text-success" title="{{ $pedido->anotacao->descricao }}"></a>
                                        @endif
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
    <script src="{{ asset('js/pedido/index.js') }}"></script>
@stop