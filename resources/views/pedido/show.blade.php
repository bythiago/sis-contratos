@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pedido: {{ $dados['pedido']->id }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- form start -->
                <form id="formulario-lista" role="form" method="PUT" action="{{ route('pedidos.update', $dados['pedido']->id) }}" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cliente">Nome</label>
                                    <input type="text" class="form-control" id="cliente" name="pedido[nome]" value="{{ $dados['pedido']->cliente->nome }}" required="true" readonly>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="pedido-id-produto">Produtos</label>
                                    <select name="pedido[id-produto]" id="pedido-id-produto" class="form-control" data-placeholder="Selecione um produto" data-href="{{ route('api.autocomplete.produtos') }}" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="cliente">Quantidade</label>
                                    <input type="number" class="form-control" name="pedido[quantidade]" required="true" max="999" min="0">
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- <a href="{{ route('pedidos.index') }}" class="btn btn-info">
                            Voltar
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </a> --}}

                        <button type="submit" id="btn-salvar" value="salvar" class="btn btn-info">
                            Adicionar Produto
                            <i class="fa fa-plus"></i>
                        </button>

                        <button type="submit" id="btn-salvar" value="salvar" class="btn btn-success float-right">
                            Concluir orçamento
                            <i class="fa fa-money-bill"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="pedido-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>@</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
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