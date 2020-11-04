@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Novo Produto</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                {{-- <div class="card-header">
                    <h3 class="card-title">Cliente</h3>
                </div> --}}
                <!-- form start -->
                <form id="formulario-lista" method="POST" role="form" action="{{ route('produto.store') }}" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-nome">Nome</label>
                                    <input type="text" class="form-control" id="produto-nome" name="produto-nome" required="true" minlength="2">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-categoria">Categoria</label>
                                    <select name="produto-categoria" class="form-control">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-descricao">Descrição</label>
                                    <textarea name="produto-descricao" class="form-control" rows="3" required="true"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-preco">Preço</label>
                                    <input type="text" class="form-control" name="produto-preco" required="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('cliente.index') }}" class="btn btn-info">
                            Voltar
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </a>

                        <button type="submit" id="btn-salvar" value="salvar" class="btn btn-success">
                            Salvar
                            <i class="fa fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('js/cliente/lista.js') }}"></script>
@stop