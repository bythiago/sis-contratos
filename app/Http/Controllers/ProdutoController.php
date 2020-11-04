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

class ProdutoController extends Controller
{
    public function index()
    {
        $dados = [
            'produtos' => $this->all()
        ];

        return view('produto.index', compact('dados'));
    }

    public function create()
    {
        $dados = [
            'categorias' => $this->findAllCategoria()
        ];

        return view('produto.create', compact('dados'));
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);
            
            $produto = new Produto();
            $produto->id_categoria = $dados['produto-categoria'];
            $produto->nome = $dados['produto-nome'];
            $produto->descricao = $dados['produto-descricao'];
            $produto->preco = $dados['produto-preco'];
            $produto->status = 1;

            $produto->save();

            DB::beginTransaction();
            //
            DB::commit();

            return response()->json([
                'message' => "{$produto->nome} foi cadastrado com sucesso"
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
            'produto' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('produto.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = [
            'readonly' => false,
            'produto' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('produto.show', compact('dados'));
    }

    public function update(Request $request, $id){

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            //
            $produto = $this->find($id);
            $produto->id_categoria = $dados['produto-categoria'];
            $produto->nome = $dados['produto-nome'];
            $produto->descricao = $dados['produto-descricao'];
            $produto->preco = $dados['produto-preco'];
            $produto->save();

            DB::commit();
            return response()->json([
                'message' => "<strong>{$produto->nome}</strong> foi alterado com sucesso"
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
            $produto = $this->find($request->get('id'));
            $produto->delete();
            DB::commit();

            return response()->json([
                'message' => "<strong>{$produto->nome}</strong> foi removido com sucesso"
            ], 200);
            
        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    //--------------------------------------------------------------------------------//
    
    private function findAllCategoria()
    {
        return CategoriaProduto::all();
    }

    private function find($id){
        return Produto::find($id)->with('categoria')->first();
    }

    private function all(){
        return Produto::all();
    }

    //--------------------------------------------------------------------------------//

}
