<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{

    private $produto;
    private $categoria;

    public function __construct(Categoria $categoria, Produto $produto)
    {
        $this->categoria = $categoria;
        $this->produto = $produto;
    }

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
        // $validation = $request->validate([
        //     'nome' => 'required|min:100',
        //     '*.foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);

        try {

            DB::beginTransaction();
            
            $dados = [];
            $dados = $request->all();
            $dados = $request->all();
            
            if($request->hasFile('produto')){
                $dados['produto']['imagem'] = $dados['produto']['foto']->store('produtos', ['disk' => 'public']);
            }

            $produto = new $this->produto;
            $produto = $produto->create($dados['produto']);

            //
            DB::commit();

            return response()->json([
                'message' => "<strong>{$produto->nome}</strong> foi cadastrado com sucesso"
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
            $dados = $request->all();
            
            DB::beginTransaction();
            
            //
            $produto = $this->find($id);

            if($request->hasFile('produto')){
                $dados['produto']['imagem'] = $dados['produto']['foto']->storeAs(null, $produto->imagem, ['disk' => 'public']);
            }

            //
            $produto->update($dados['produto']);

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
            
            if (Storage::disk('public')->exists($produto->imagem)) {
                Storage::disk('public')->delete($produto->imagem);
            }

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

    protected function autocompleteProdutoByName(Request $request)
    {
        $produtos = $this->findByNameProduto($request->get('q'));
        
        $data['results'] = $produtos->map(function($produto){
            return [
                'id' => $produto->id,
                'text' => "({$produto->nome}) R$ {$produto->preco}"
            ];
        });

        return response()->json($data);
    }

    //--------------------------------------------------------------------------------//
    
    private function findAllCategoria()
    {
        return $this->categoria::all(['id', 'descricao']);
    }

    private function find($id){
        return $this->produto::where('id', $id)->with('categoria')->first();
    }

    private function all(){
        return $this->produto::all();
    }

    private function findByNameProduto($q)
    {
        return $this->produto::whereRaw( 'UPPER(`nome`) LIKE ?', '%'.strtoupper($q).'%')->get();
    }

    //--------------------------------------------------------------------------------//

}
