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
    //private $cliente;
    private $pedido;
    private $produto;
    //private $tipoAnotacao;

    public function __construct(Pedido $pedido, Produto $produto)
    {
        //$this->cliente = $cliente;
        $this->pedido = $pedido;
        $this->produto = $produto;
        //$this->tipoAnotacao = $tipoAnotacao;
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
                'message' => "Pedido <strong>{$pedido->numero}</strong> foi cadastrado com sucesso"
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
        $pedido = $this->pedido::with('orcamento')->with('cliente')->where('id', $id)->first();
        
        $dados = [
            'pedido' => $pedido,
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

            $orcamento = $pedido->orcamento()->updateOrCreate(['id_pedido' => $pedido->id], $dados['orcamento']);
            
            $produto = $orcamento->produtos()->find($dados['produto']['id_produto']);

            if(is_null($produto)){
                $orcamento->produtos()->attach($orcamento->id, $dados['produto']);
            } else {
                $produto->pivot->quantidade = $produto->pivot->quantidade + $dados['produto']['quantidade'];
                $produto->pivot->update();
            }
            //
            DB::commit();

            return response()->json([
                'message' => "Pedido <strong>{$pedido->numero}</strong> foi atualizado com sucesso"
            ], 200);

        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }

    }

    public function updateProduct(Request $request, $id){

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
                'message' => "Pedido <strong>{$pedido->numero}</strong> foi cadastrado com sucesso"
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
                'message' => "<strong>Pedido {$pedido->numero}</strong> foi removido com sucesso"
            ], 200);
            
        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function destroyProduct(Request $request, $id, $produto)
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

    private function find($id){
        return Pedido::where('id', $id)->with('cliente')->get();
    }
    
    private function all(){
        return Pedido::with(['anotacao', 'cliente', 'status'])->get();
    }

    private function calculaValorTotalProduto($produto){
        return $this->produto::find($produto['id_produto'])->preco * floatval($produto['quantidade']);
    }

    //--------------------------------------------------------------------------------//

}
