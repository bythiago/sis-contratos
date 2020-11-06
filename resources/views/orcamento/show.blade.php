@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pedido: {{ $dados['pedidos']->id }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- form start -->
                <form id="formulario-lista" method="POST" action="{{ route('orcamento.store') }}" role="form" novalidate>
                    {{-- <input type="hidden" name="pedido-id" value="{{ $dados['pedidos']->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class="form-group">
                                    <label for="pedido-id-produto">Produtos</label>
                                    <select name="pedido-id-produto" class="form-control" required>
                                        <option value="">Selecione uma produto</option>
                                        @foreach ($dados['produtos'] as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <button id="btnProdutoAdicionar" type="button" class="btn btn-success btn-flat" style="margin: 2em 0;">
                                    <em class="fa fa-plus"></em>
                                </button>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <table id="orcamento-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@</th>
                                            <th>Cliente</th>
                                            <th>Anotação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dados['pedidos']->orcamentos()->get() as $orcamento)
                                            <tr>
                                                {{-- @if ($orcamento->produtos()->first()) --}}
                                                <td>{{ $orcamento->id }}</td>
                                                <td>{{ $dados['pedidos']->cliente()->first()->nome }}</td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-info btn-sm btn-show" data-href="{{ route('orcamento.show', $orcamento->id) }}">
                                                        <i class="fa fa-list"></i>
                                                    </button>
                                                    <button class="btn btn-success btn-sm btn-edit" data-href="{{ route('orcamento.edit', $orcamento->id) }}">
                                                        <i class="fa fa-handshake"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm btn-destroy" data-href="{{ route('orcamento.destroy', $orcamento->id) }}" data-orcamento="{{ $orcamento }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                    {{-- <td>{{ $orcamento->produtos()->first()->nome }}</td> --}}
                                                    {{-- @dump($orcamento->produtos()->first()->toArray()) --}}
                                                    {{-- @endif --}}
                                                    {{-- @dump($pedido->orcamentos()->get()[7]->produtos()->get()->toArray()) --}}
                                                    {{-- @dump($orcamento->toArray()) --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('pedido.index') }}" class="btn btn-info">
                            Voltar
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </a>
                        
                        @if (empty($dados['readonly']))
                            <button type="submit" id="btn-salvar" value="salvar" class="btn btn-success">
                                Salvar
                                <i class="fa fa-save"></i>
                            </button>
                        @endif
                    </div>                
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        var readonly = "{{ $dados['readonly'] }}"
    </script>
    <script src="{{ asset('js/orcamento/index.js') }}"></script>
@stop