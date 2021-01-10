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
                <form id="formulario-pedido" role="form" method="PUT" action="{{ route('pedidos.update', $dados['pedido']) }}" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cliente">Nome</label>
                                    <input type="text" class="form-control" value="{{ $dados['pedido']->cliente->nome }}" readonly>
                                    <input type="hidden" name="pedido[id_status]" value="2">
                                    <input type="hidden" name="orcamento[status]" value="1">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="pedido-id-produto">Produtos</label>
                                    <select name="produto[id_produto]" id="pedido-id-produto" class="form-control" data-placeholder="Selecione um produto" data-href="{{ route('api.autocomplete.produtos') }}" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente">Quantidade</label>
                                    <input type="number" class="form-control" name="produto[quantidade]" max="999" min="0" required>
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

                        <button type="submit" id="btn-salvar" data-redirect={{ route('pedidos.show', ['pedido' => $dados['pedido']->id]) }} value="salvar" class="btn btn-info">
                            Adicionar Produto
                            <i class="fa fa-plus"></i>
                        </button>

                        @if($dados['pedido']->status->tipo === App\Models\Pedido::ORCAMENTO_PARCIAL)
                            <button type="button" id="btn-update" data-pedido="{{ $dados['pedido'] }}" data-redirect={{ route('pedidos.index') }} data-href="{{ route('pedidos.update2', ['id' => $dados['pedido']->id])}}" class="btn btn-success float-right">
                                Concluir orçamento
                                <i class="fa fa-money-bill"></i>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
            
            @if($dados['pedido']->orcamento)
                <div class="card">
                    <div class="card-body">
                        <table id="pedido-table" class="table table-bordered" style="width: 100%">
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
                                @php 
                                    $total = 0;
                                    $quantidade = 0; 
                                @endphp
                                @foreach ($dados['pedido']->orcamento->produtos as $item)
                                    @php 
                                        $total += $item->pivot->total;
                                        $quantidade += $item->pivot->quantidade
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>({{ $item->nome }}) {{  'R$ '.number_format($item->preco, 2, ',', '.') }}</td>
                                        <td>{{ $item->pivot->quantidade }}</td>
                                        <td>{{  'R$ '.number_format($item->pivot->total, 2, ',', '.') }}</td>
                                        <td>
                                            <em data-pedido="{{ $item }}" data-href="{{ route('pedidos.destroy2', ['id' => $dados['pedido']->id, 'produto' => $item->id])}}" style="cursor: pointer" class="btn-destroy fas fa-2x fa-trash text-danger"></em>
                                            {{-- <em data-pedido="{{ $item }}" data-href="{{ route('pedidos.update2', ['id' => $dados['pedido']->id])}}" style="cursor: pointer" class="btn-update fas fa-2x fa-user text-info"></em>                                             --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{ $quantidade }}</th>
                                    <th>{{  'R$ '.number_format($total, 2, ',', '.') }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endif
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