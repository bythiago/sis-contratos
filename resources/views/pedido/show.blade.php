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
                                    <label for="pedido-nome">Nome</label>
                                    <input type="text" class="form-control" id="pedido-nome" name="pedido-nome" value="{{ $dados['pedido']->nome }}" required="true" minlength="2">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pedido-categoria">Categoria</label>
                                    <select name="pedido-categoria" class="form-control">
                                        <option value="">Selecione uma categoria</option>
                                        @foreach ($dados['categorias'] as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $dados['pedido']->categoria()->first()->id === $categoria->id ? 'selected' : '' }}>{{ $categoria->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pedido-descricao">Descrição</label>
                                    <textarea name="pedido-descricao" class="form-control" rows="3" required="true">{{ $dados['pedido']->descricao }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pedido-preco">Preço</label>
                                    <input type="text" class="form-control" name="pedido-preco" value="{{ $dados['pedido']->preco }}" required="true" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'rightAlign': false">
                                </div>
                            </div>
                        </div>
                    </div>       
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-info">
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
        var readonly = "{{ $dados['readonly'] }}";

        $(document).ready(function(){
            Pedido.default.iniciar();
        }
    </script>
@stop