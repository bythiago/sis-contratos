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
                                <th>Status</th>
                                <th>Anotação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados['pedidos'] as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->cliente()->first()->nome }}</td>
                                    <td>{{ $pedido->status()->first()->descricao }}</td>
                                    <td>{{ $pedido->id_anotacao }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm btn-show" data-href="{{ route('pedido.show', $pedido->id) }}">
                                            <i class="fa fa-list"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm btn-edit" data-href="{{ route('pedido.edit', $pedido->id) }}">
                                            <i class="fa fa-handshake"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-destroy" data-href="{{ route('pedido.destroy', $pedido->id) }}" data-pedido="{{ $pedido }}">
                                            <i class="fa fa-trash"></i>
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
    <script src="{{ asset('js/pedido/index.js') }}"></script>
@stop