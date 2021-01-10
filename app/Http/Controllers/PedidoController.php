<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\TipoAnotacao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    private $cliente;
    private $pedido;
    private $produto;
    private $tipoAnotacao;

    public function __construct(Cliente $cliente, Pedido $pedido, Produto $produto, TipoAnotacao $tipoAnotacao)
    {
        $this->cliente = $cliente;
        $this->pedido = $pedido;
        $this->produto = $produto;
        $this->tipoAnotacao = $tipoAnotacao;
    }

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
        $pedido = $this->pedido::find($id);
        
        // $orcamento = $pedido->orcamento;

        // dd($orcamento->produtos());

        $dados = [
            'pedido' => $pedido,
            'produtos' => $this->produto::all()
        ];

        return view('pedido.show', compact('dados'));
    }

    public function edit($id)
    {
        $dados = [
            'pedido' => $this->find($id),
            'categorias' => $this->findAllCategoria()
        ];

        return view('pedido.show', compact('dados'));
    }

    public function update(Request $request, $id){

        try {
            
            $dados = [];
            parse_str($request->get('dados'), $dados);

            $dados['produto']['total'] = $this->calculaValorTotalProduto($dados['produto']);

            DB::beginTransaction();
            $pedido = $this->pedido::findOrFail($id);
            $pedido->update($dados['pedido']);

            $orcamento = $pedido->orcamento()->updateOrCreate($dados['orcamento']);
            
            $orcamento->produtos()->attach($orcamento->id, $dados['produto']);           
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

    public function update2(Request $request, $id){

        try {

            $dados = [
                'orcamento' => $request->get('orcamento'),
                'pedido' => $request->get('pedido')
            ];

            DB::beginTransaction();
            $pedido = $this->pedido::findOrFail($id);
            $pedido->update($dados['pedido']);
            $pedido->orcamento()->update($dados['orcamento']);

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


    public function destroy(Request $request)
    {       
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

    public function destroy2(Request $request, $id, $produto)
    {
        $dados = [
            'pedido' => $request->get('pedido')
        ];

        DB::beginTransaction();
        
        $pedido = $this->pedido::findOrFail($id);
        $pedido->update($dados['pedido']);
        
        $pedido->orcamento->produtos()->detach($produto);
        
        //
        DB::commit();

        return response()->json([
            'message' => "Produto foi removido com sucesso"
        ], 200);
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

    private function calculaValorTotalProduto($produto){
        return $this->produto::find($produto['id_produto'])->preco * floatval($produto['quantidade']);
    }

    //--------------------------------------------------------------------------------//

}
