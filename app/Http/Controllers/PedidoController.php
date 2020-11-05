<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Produto;
use App\Models\Sexo;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
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
            
            $pedido = new Produto();
            $pedido->id_categoria = $dados['pedido-categoria'];
            $pedido->nome = $dados['pedido-nome'];
            $pedido->descricao = $dados['pedido-descricao'];
            $pedido->preco = $dados['pedido-preco'];
            $pedido->status = 1;

            $pedido->save();

            DB::beginTransaction();
            //
            DB::commit();

            return response()->json([
                'message' => "{$pedido->nome} foi cadastrado com sucesso"
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
        $dados = [
            'readonly' => true,
            'pedido' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('pedido.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = [
            'readonly' => false,
            'pedido' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('pedido.show', compact('dados'));
    }

    public function update(Request $request, $id){

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            //
            $pedido = $this->find($id);
            $pedido->id_categoria = $dados['pedido-categoria'];
            $pedido->nome = $dados['pedido-nome'];
            $pedido->descricao = $dados['pedido-descricao'];
            $pedido->preco = $dados['pedido-preco'];
            $pedido->save();

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
        try {
            DB::beginTransaction();
            $pedido = $this->find($request->get('id'));
            $pedido->delete();
            DB::commit();

            return response()->json([
                'message' => "<strong>{$pedido->nome}</strong> foi removido com sucesso"
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
        return Cliente::all();
    }

    private function findAllCategoria()
    {
        return;// CategoriaProduto::all();
    }

    private function find($id){
        return;// Produto::where('id', $id)->with('categoria')->first();
    }
    

    private function all(){
        return; //Produto::all();
    }

    //--------------------------------------------------------------------------------//

}
