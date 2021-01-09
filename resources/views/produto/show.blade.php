@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Produto: {{ $dados['produto']->nome }}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- form start -->
                <form id="formulario-lista" role="form" method="PUT" action="{{ route('produtos.update', $dados['produto']->id) }}" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-nome">Nome</label>
                                    <input type="text" class="form-control" id="produto-nome" name="produto[nome]" value="{{ $dados['produto']->nome }}" required="true" minlength="2">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-categoria">Categoria</label>
                                    <select name="produto[id_categoria]" class="form-control">
                                        <option value="">Selecione uma categoria</option>
                                        @foreach ($dados['categorias'] as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $dados['produto']->categoria()->first()->id === $categoria->id ? 'selected' : '' }}>{{ $categoria->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-descricao">Descrição</label>
                                    <textarea name="produto[descricao]" class="form-control" rows="3" required="true">{{ $dados['produto']->descricao }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="produto-preco">Preço</label>
                                    <input type="text" class="form-control" name="produto[preco]" value="{{ $dados['produto']->preco }}" required="true" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'rightAlign': false">
                                </div>
                            </div>
                        </div>
                    </div>       
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('produtos.index') }}" class="btn btn-info">
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
        Produto.default.iniciar();
    </script>
@stop