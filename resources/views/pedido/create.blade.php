@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Novo Pedido</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                {{-- <div class="card-header">
                    <h3 class="card-title">Cliente</h3>
                </div> --}}
                <!-- form start -->
                <form id="formulario-lista" method="POST" role="form" action="{{ route('pedido.store') }}" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pedido-cliente">Cliente</label>
                                    <select name="pedido-cliente" id="pedido-cliente" class="form-control select2" required>
                                        @foreach ($dados['clientes'] as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->cpf }} - {{ $cliente->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pedido-anotacao">Anotação</label>
                                    <textarea name="pedido-anotacao" class="form-control" rows="3" required="true"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('pedido.index') }}" class="btn btn-info">
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
    <script src="{{ asset('js/pedido/index.js') }}"></script>
@stop