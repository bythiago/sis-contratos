@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Novo Cliente</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <!-- form start -->
                <form id="formulario-lista" role="form" method="PUT" action="{{ route('clientes.update', $cliente->id) }}" novalidate>
                    <div class="card-body">                   
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-nome">Nome</label>
                                    <input type="text" class="form-control" id="cliente-nome" name="cliente[nome]" value="{{ $cliente->nome }}" required="true" minlength="2">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-cpf">CPF</label>
                                    <input type="text" class="form-control" name="cliente[cpf]" value="{{ $cliente->cpf }}" data-inputmask="&quot;mask&quot;: &quot;999.999.999-99&quot;" data-mask="" im-insert="true" required="true">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-rg">RG</label>
                                    <input type="text" class="form-control" name="cliente[rg]" value="{{ $cliente->rg }}" data-inputmask="&quot;mask&quot;: &quot;99999999-9&quot;" data-mask="" im-insert="true" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cliente-sexo">Sexo</label>
                                    <select class="form-control" name="cliente[id_sexo]" required>
                                        <option value="">Selecione o sexo</option>
                                        @foreach ($sexos as $sexo)
                                            <option value="{{ $sexo->id }}" {{ $sexo->id == $cliente->id_sexo ? 'selected' : '' }}>{{ $sexo->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cliente-nascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="cliente[nascimento]" value="{{ $cliente->nascimento }}" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cliente-cep">CEP</label>
                            <input type="text" class="form-control" id="cep" value="{{ $cliente->cep }}" name="cliente[cep]" data-inputmask="&quot;mask&quot;: &quot;99999-999&quot;" data-mask="" im-insert="true" required="true">
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-rua">Rua</label>
                                    <input type="text" class="form-control" id="rua" name="cliente[rua]" value="{{ $cliente->rua }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="cliente[bairro]" value="{{ $cliente->bairro }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-numero">Número</label>
                                    <input type="text" class="form-control" id="numero" name="cliente[numero]" value="{{ $cliente->numero }}" required="true">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cliente[cidade]" value="{{ $cliente->cidade }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cliente-uf">UF</label>
                                    <input type="text" class="form-control" id="uf" name="cliente[uf]" value="{{ $cliente->uf }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">

                            @foreach ($cliente->contatos as $contato)
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cliente-contato">{{$contato->tipoContato->descricao}}</label>
                                        <input type="hidden" class="form-control" name="contato[{{$contato->id}}][id_tipo_contato]" value="{{$contato->id_tipo_contato}}" required>
                                        
                                        @if ($contato->tipoContato->tipo === "email")
                                            <input type="email" class="form-control" name="contato[{{$contato->id}}][contato]" value="{{ $contato->contato }}" required>
                                        @else
                                            <input type="text" class="form-control" name="contato[{{$contato->id}}][contato]" value="{{ $contato->contato }}" minlength="10" data-inputmask="'mask': '(99)99999999[9]', 'greedy' : true" required>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    
                        <div class="form-group">
                            <label for="cliente-observacao">Observação</label>
                            <textarea name="cliente[observacao]" class="form-control" rows="3" required="true">{{ $cliente->observacao }}</textarea>
                        </div>
                    </div>
                    
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('clientes.index') }}" class="btn btn-info">
                            Voltar
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </a>
                        
                        @if (empty($readonly))
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
        var readonly = "{{ $readonly }}"
        Cliente.default.iniciar();
    </script>
@stop