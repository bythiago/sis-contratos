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
                <form id="formulario-lista" method="POST" role="form" action="{{ route('produtos.store') }}" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="produto-nome" name="produto[nome]" required="true" minlength="2">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="id_categoria">Categoria</label>
                                    <select name="produto[id_categoria]" class="form-control" required>
                                        <option value="">Selecione uma categoria</option>
                                        @foreach ($dados['categorias'] as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea name="produto[descricao]" class="form-control" rows="3" required="true"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="preco">Preço</label>
                                    <input type="text" class="form-control" name="produto[preco]" required="true" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'rightAlign': false">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="produto[foto]" class="custom-file-input">
                                            <label class="custom-file-label" for="foto">Escolher arquivo</label>
                                        </div>
                                    </div>
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

                        <button type="submit" id="btn-salvar" value="salvar" class="btn btn-success">
                            Salvar
                            <i class="fa fa-save"></i>
                        </button>
                    </div>

                    <input type="hidden" name="produto[status]" value="1">
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        Produto.default.iniciar();
    </script>
@stop