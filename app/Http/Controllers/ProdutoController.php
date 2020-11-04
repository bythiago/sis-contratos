<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Sexo;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index()
    {
        $dados = [];
        return view('produto.index', compact('dados'));
    }

    public function create()
    {
        $dados = [
            'categoria' => $this->findAllCategoria()
        ];
        
        return view('produto.create', compact('dados'));
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            //
            DB::commit();

            // return response()->json([
            //     'message' => "{$cliente->nome} foi cadastrado com sucesso"
            // ], 500);

        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $dados = [];
        return view('produto.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = [];
        return view('produto.show', compact('dados'));
    }

    public function update(Request $request, $id){

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            //
            DB::commit();
            // return response()->json([
            //     'message' => "<strong>{$cliente->nome}</strong> foi alterado com sucesso"
            // ], 200);

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
            //$cliente = $this->find($request->get('clienteId'));
            //$cliente->contatos()->delete();
            //$cliente->delete();
            DB::commit();

            // return response()->json([
            //     'message' => "<strong>{$cliente->nome}</strong> foi removido com sucesso"
            // ], 200);
            
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
        return;
    }

    private function all(){
        return;
    }

    //--------------------------------------------------------------------------------//

}
