@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<form id="formulario-lista" method="POST" role="form" action="{{ route('orcamento.store') }}" novalidate>
    <div id="app" class="row">
        
      <example-component></example-component>
        {{-- <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="">
                                <div class="input-group mb-32">
                                    {{-- <input type="hidden" name="pedido-id" value="{{ $dados['pedidos']->id }}"> --}}
                                    <input type="hidden" name="pedido-id" value="1">
                                    <select id="pedido-id-produto" name="pedido-id-produto" data-placeholder="Selecione o Produto" data-href="{{ route('orcamento.autocomplete') }}" class="form-control" required>
                                        <option></option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-append">
                                            <button type="submit" id="btnProdutoAdicionar" class="btn btn-success btn-flat">
                                                <em class="fa fa-plus"></em>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                  <thead>
                                  <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                    <th>More</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>
                                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                      Some Product
                                    </td>
                                    <td>$13 USD</td>
                                    <td>
                                      <small class="text-success mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        12%
                                      </small>
                                      12,000 Sold
                                    </td>
                                    <td>
                                      <a href="#" class="text-muted">
                                        <i class="fas fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                      Another Product
                                    </td>
                                    <td>$29 USD</td>
                                    <td>
                                      <small class="text-warning mr-1">
                                        <i class="fas fa-arrow-down"></i>
                                        0.5%
                                      </small>
                                      123,234 Sold
                                    </td>
                                    <td>
                                      <a href="#" class="text-muted">
                                        <i class="fas fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                      Amazing Product
                                    </td>
                                    <td>$1,230 USD</td>
                                    <td>
                                      <small class="text-danger mr-1">
                                        <i class="fas fa-arrow-down"></i>
                                        3%
                                      </small>
                                      198 Sold
                                    </td>
                                    <td>
                                      <a href="#" class="text-muted">
                                        <i class="fas fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                      Perfect Item
                                      <span class="badge bg-danger">NEW</span>
                                    </td>
                                    <td>$199 USD</td>
                                    <td>
                                      <small class="text-success mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        63%
                                      </small>
                                      87 Sold
                                    </td>
                                    <td>
                                      <a href="#" class="text-muted">
                                        <i class="fas fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Messages</span>
                                    <span class="info-box-number">1,410</span>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="info-box">
                                  <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Messages</span>
                                    <span class="info-box-number">1,410</span>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">Bookmarks</span>
                                      <span class="info-box-number">41,410</span>
                                      <div class="progress">
                                        <div class="progress-bar bg-info" style="width: 70%"></div>
                                      </div>
                                      <span class="progress-description">
                                        70% Increase in 30 Days
                                      </span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="" class="btn btn-success">Salvar</a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/orcamento/index.js') }}"></script>
@stop