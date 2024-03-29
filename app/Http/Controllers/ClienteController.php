<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sexo;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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

    public function dataTableClients(){
        return DataTables::of($this->all())
        ->addColumn('action', function ($cliente) {
            
            $action[0] = sprintf("
                <button class='btn btn-info btn-sm btn-show' data-href='%s'>
                    <i class='fa fa-search'></i>
                </button>
                <button class='btn btn-success btn-sm btn-edit' data-href='%s'>
                    <i class='fa fa-edit'></i>
                </button>",
                route('clientes.show', $cliente->id),
                route('clientes.edit', $cliente->id),
            );

            if(!$cliente->pedidos->count()){
                $action[1] = sprintf("
                    <button class='btn btn-danger btn-sm btn-destroy' data-href='%s' data-cliente='%s'>
                        <i class='fa fa-trash'></i>
                    </button>", route('clientes.destroy', $cliente->id), $cliente
                );
            }

            return implode($action);
        })
        ->make();
    }

    //--------------------------------------------------------------------------------//

    private function findSexo(){
        return $this->sexo::select(['id', 'descricao'])->get();
    }

    private function findTipoContato(){
        return $this->tipoContato::select(['id', 'tipo', 'descricao'])->get();
    }

    private function find($id){
        return $this->cliente::whereId($id)->with(['contatos'])->first();
    }

    private function all(){
        return $this->cliente::with(['sexo', 'pedidos'])->get();
    }

    //--------------------------------------------------------------------------------//

}
