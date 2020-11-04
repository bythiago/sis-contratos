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
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados['produtos'] as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>{{ $produto->preco }}</td>
                                    <td>{{ $produto->status }}</td>
                                    <td>
                                    <button class="btn btn-info btn-sm btn-show" data-href="{{ route('produto.show', $produto->id) }}">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm btn-edit" data-href="{{ route('produto.edit', $produto->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-destroy" data-href="{{ route('produto.destroy', $produto->id) }}" data-produto="{{ $produto }}">
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
    <script src="{{ asset('js/produto/index.js') }}"></script>
@stop