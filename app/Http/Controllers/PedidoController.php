<?php

namespace App\Http\Controllers;

use App\Models\Anotacao;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\TipoAnotacao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends OrcamentoController
{
    public function index()
    {
      
        $dados = [
            'pedidos' => $this->all()
        ];

        return view('pedido.index', compact('dados'));
    }

    public function create()
    {

        $dados = [
            'clientes' => $this->findAllCliente()
        ];

        return view('pedido.create', compact('dados'));
    }

    public function store(Request $request)
    {

        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);
            
            DB::beginTransaction();

            $pedido = new Pedido();
            $pedido = $pedido->create($dados['pedido']);
            $pedido->anotacao()->create($dados['anotacao']);
            
            //
            DB::commit();

            return response()->json([
                'message' => "Pedido <strong>{$pedido->id}</strong> foi cadastrado com sucesso"
            ], 200);

        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $this->forget();

        $dados = [
            'readonly' => true,
            'pedido' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('pedido.show', compact('dados'));
    }

    public function edit($id)
    {
        $this->forget();

        $dados = [
            'readonly' => false,
            'pedido' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('pedido.show', compact('dados'));
    }

    public function update(Request $request, $id){

        $this->forget();

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            //
            $pedido = $this->find($id);
            $pedido->update($dados['pedido']);
            $pedido->anotacao()->update($dados['anotacao']);

            DB::commit();
            return response()->json([
                'message' => "<strong>{$pedido->nome}</strong> foi alterado com sucesso"
            ], 200);

        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }


    public function destroy(Request $request)
    {
        $this->forget();
        
        try {
            
            DB::beginTransaction();
            $pedido = $this->find($request->get('id'));
            $pedido->delete();
            DB::commit();

            return response()->json([
                'message' => "<strong>Pedido {$request->get('id')}</strong> foi removido com sucesso"
            ], 200);
            
        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    //--------------------------------------------------------------------------------//

    private function findAllCliente()
    {
        return Cliente::all(['id', 'cpf', 'nome']);
    }

    private function findAllProduto(){
        return Produto::all();
    }

    private function findAllCategoria()
    {
        return;// CategoriaProduto::all();
    }

    private function find($id){
        return Pedido::where('id', $id)->with('cliente');
    }
    
    private function findByTipoAnotacao($tipo)
    {
        return TipoAnotacao::where('tipo', $tipo)->first()->id;
    }

    private function all(){
        return Pedido::all();
    }

    //--------------------------------------------------------------------------------//

}
