@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Novo Cliente</h1>
@stop

@section('content')
    <div class="row">
        <!--div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div-->
        <div class="col-12">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form">
                  <div class="card-body">
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-nome">Nome</label>
                                <input type="text" class="form-control" id="cliente-nome" name="cliente-nome" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-cpf">CPF</label>
                                <input type="text" class="form-control" name="cliente-cpf" data-inputmask="&quot;mask&quot;: &quot;999.999.999-99&quot;" data-mask="" im-insert="true">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" name="nascimento" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cliente-cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cliente-cep" data-inputmask="&quot;mask&quot;: &quot;99999-999&quot;" data-mask="" im-insert="true">
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-rua">Rua</label>
                                <input type="text" class="form-control" id="rua" name="cliente-rua" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-bairro">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="cliente-bairro" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-numero">Número</label>
                                <input type="text" class="form-control" id="numero" name="cliente-numero" placeholder="">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-cidade">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cliente-cidade" placeholder="">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="cliente-uf">UF</label>
                                <input type="text" class="form-control" id="uf" name="cliente-uf" placeholder="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Observação</label>
                        <textarea name="observacao" class="form-control" rows="3" placeholder=""></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">
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