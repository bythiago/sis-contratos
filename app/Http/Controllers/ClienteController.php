<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\Sexo;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
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
        $tipoContato = $this->findTipoContato();
        return view('cliente.create', compact('tipoContato'));
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
           
            $cliente = new Cliente();
            $cliente = $cliente->create($dados['cliente']);
            $cliente->contatos()->create($dados['contato']);

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
            $cliente->contatos()->update($dados['contato']);

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

    //--------------------------------------------------------------------------------//

    private function findSexo(){
        return Sexo::all();
    }

    private function findTipoContato(){
        return TipoContato::all();
    }

    private function find($id){
        return Cliente::where('id', $id)->with('contatos')->first();
    }

    private function all(){
        return Cliente::all();
    }

    //--------------------------------------------------------------------------------//

}
