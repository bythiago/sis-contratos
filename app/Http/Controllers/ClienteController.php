<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sexo;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    private $cliente;
    private $sexo;
    private $tipoContato;

    public function __construct(Cliente $cliente, Sexo $sexo, TipoContato $tipoContato)
    {
        $this->cliente = $cliente;
        $this->sexo = $sexo;
        $this->tipoContato = $tipoContato;
    }

    public function index()
    {
        $dados = [
            'readonly' => false,
            'cliente' => $this->all()
        ];

        return view('cliente.index', compact('dados'));
    }

    public function create()
    {   
        $dados = [
            'tipoContato' => $this->findTipoContato(),
            'sexos' => $this->findSexo()
        ];

        return view('cliente.create', compact('dados'));
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
           
            $cliente = new $this->cliente();
            $cliente = $cliente->create($dados['cliente']);

            foreach($dados['contato'] as $contato){
                $cliente->contatos()->create($contato);
            }

            DB::commit();

            return response()->json([
                'message' => "<strong>{$cliente->nome}</strong> foi cadastrado com sucesso"
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
        return view('cliente.show', [
                'sexos' => $this->findSexo(),
                'tipoContato' => $this->findTipoContato(),
                'cliente' => $this->find($id),
                'readonly' => true
            ]
        );
    }

    public function edit($id)
    {
        return view('cliente.show', [
                'sexos' => $this->findSexo(),
                'tipoContato' => $this->findTipoContato(),
                'cliente' => $this->find($id),
                'readonly' => false
            ]
        );
    }

    public function update(Request $request, $id){

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();

            $cliente = $this->find($id);
            $cliente->update($dados['cliente']);

            foreach($dados['contato'] as $i => $contato){
                $cliente->contatos()->find($i)->update($contato);
            }

            DB::commit();
            return response()->json([
                'message' => "<strong>{$cliente->nome}</strong> foi alterado com sucesso"
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
            $cliente = $this->find($request->get('clienteId'));
            $cliente->contatos()->delete();
            $cliente->delete();
            DB::commit();

            return response()->json([
                'message' => "<strong>{$cliente->nome}</strong> foi removido com sucesso"
            ], 200);
            
        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function calendar(){

        $clientes = Cliente::all()->toJson();

        return view('cliente.calendar', compact('clientes'));
    }

    //--------------------------------------------------------------------------------//

    private function findSexo(){
        return $this->sexo::all();
    }

    private function findTipoContato(){
        return $this->tipoContato::all();
    }

    private function find($id){
        return $this->cliente::where('id', $id)->with('contatos')->first();
    }

    private function all(){
        return $this->cliente::all();
    }

    //--------------------------------------------------------------------------------//

}
