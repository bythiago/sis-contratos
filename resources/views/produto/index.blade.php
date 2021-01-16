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
                    <table id="produto-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados['produtos'] as $produto)
                                <tr>
                                    <td>
                                        @if ($produto->imagem)
                                            <img src="{{ asset('storage/'.$produto->imagem) }}" title="{{ $produto->nome }}" class="img-circle img-size-32 mr-2" width="150" height="150">
                                        @else
                                            <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" title="{{ $produto->nome }}" class="img-circle img-size-32 mr-2">
                                        @endif
                                    </td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>{{  'R$ '.number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td>
                                    <button class="btn btn-info btn-sm btn-show" data-href="{{ route('produtos.show', $produto->id) }}">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm btn-edit" data-href="{{ route('produtos.edit', $produto->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-destroy" data-href="{{ route('produtos.destroy', $produto->id) }}" data-produto="{{ $produto }}">
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
    <script>
        Produto.default.iniciar();
    </script>
@stop