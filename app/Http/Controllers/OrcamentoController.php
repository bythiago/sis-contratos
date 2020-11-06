<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Orcamento;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Sexo;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrcamentoController extends Controller
{
    public function index()
    {
        $dados = [
            'orcamentos' => $this->all()
        ];

        return view('orcamento.index', compact('dados'));
    }

    public function create()
    {
        $dados = [
            'categorias' => $this->findAllCategoria()
        ];

        return view('orcamento.create', compact('dados'));
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);
            
            $orcamento = new Orcamento();

            $orcamento->save();

            DB::beginTransaction();
            //
            DB::commit();

            return response()->json([
                'message' => "<strong>{$orcamento->nome}</strong> foi cadastrado com sucesso"
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
            'readonly' => false,
            'produtos' => $this->findAllProduto(),
            'pedido' => $this->findByPedido($id),
        ];

        return view('orcamento.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = [
            'readonly' => false,
            'orcamento' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('orcamento.show', compact('dados'));
    }

    public function update(Request $request, $id){

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            //
            $orcamento = $this->find($id);
            $orcamento->id_categoria = $dados['orcamento-categoria'];
            $orcamento->nome = $dados['orcamento-nome'];
            $orcamento->descricao = $dados['orcamento-descricao'];
            $orcamento->preco = $dados['orcamento-preco'];
            $orcamento->save();

            DB::commit();
            return response()->json([
                'message' => "<strong>{$orcamento->nome}</strong> foi alterado com sucesso"
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
            $orcamento = $this->find($request->get('id'));
            $orcamento->delete();
            DB::commit();

            return response()->json([
                'message' => "<strong>{$orcamento->nome}</strong> foi removido com sucesso"
            ], 200);
            
        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    //--------------------------------------------------------------------------------//
    
    private function findAllProduto(){
        return Produto::all();
    }

    private function findByPedido($id)
    {
        return Pedido::where('id', $id)->with('cliente')->first();
    }

    private function find($id){
        return Orcamento::where('id', $id)->with('categoria')->first();
    }

    private function all(){
        return Orcamento::all();
    }

    //--------------------------------------------------------------------------------//

}
