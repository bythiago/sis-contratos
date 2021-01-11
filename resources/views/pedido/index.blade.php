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
                    <table id="pedido-table" class="table table-bordered" style="width: 100%;">
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
                                            <a href="#" style="cursor: help;" class="fas fa-2x fa-info-circle" title="{{ $pedido->anotacao->descricao }}"></a>
                                        @endif
                                        
                                        <a href="{{ route('pedidos.show', ['pedido' => $pedido]) }}" class="fa fa-2x fa-cart-plus text-warning"></a>

                                        @if($pedido->status->tipo === App\Models\Pedido::ORCAMENTO_REALIZADO)
                                            <a href="#" class="fas fa-2x fa-print text-info"></a>
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
    <script>
        $(document).ready(function(){
            Pedido.default.iniciar();
        });
    </script>
@stop