<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        $dados = [
            'readonly' => "readonly",
            'cliente' => Cliente::all()
        ];

        return view('cliente.index', compact('dados'));
    }

    public function create()
    {
        $tipoContato = $this->findAllTipoContato();
        return view('cliente.create', compact('tipoContato'));
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);

            DB::beginTransaction();
            
            $cliente = new Cliente();
            $cliente->nome = $dados['cliente-nome'];
            $cliente->cpf = $dados['cliente-cpf'];
            $cliente->nascimento = $dados['cliente-nascimento'];
            $cliente->sexo = $dados['cliente-sexo'];
            $cliente->cep = $dados['cliente-cep'];
            $cliente->rua = $dados['cliente-rua'];
            $cliente->numero = $dados['cliente-numero'];
            $cliente->bairro = $dados['cliente-bairro'];
            $cliente->cidade = $dados['cliente-cidade'];
            $cliente->uf = $dados['cliente-uf'];
            $cliente->observacao = $dados['cliente-observacao'];
            $cliente->save();

            $tipo = TipoContato::where('tipo', $dados['cliente-tipo-contato'])->first();

            $contato = new Contato();
            $contato->id_cliente = $cliente;
            $contato->id_tipo_contato = $tipo->id;
            $contato->numero = $dados['cliente-contato'];
            $contato->descricao = 'web';
            $cliente->contatos()->save($contato);
            DB::commit();

            return response()->json([
                'message' => "{$cliente->nome} foi cadastrado com sucesso"
            ], 500);

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
                'tipoContato' => $this->findAllTipoContato(),
                'cliente' => $this->find($id),
                'readonly' => true
            ]
        );
    }

    public function edit($id)
    {
        return view('cliente.show', [
                'tipoContato' => $this->findAllTipoContato(),
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

            $cliente = Cliente::find($id);
            $cliente->nome = $dados['cliente-nome'];
            $cliente->cpf = $dados['cliente-cpf'];
            $cliente->nascimento = $dados['cliente-nascimento'];
            $cliente->sexo = $dados['cliente-sexo'];
            $cliente->cep = $dados['cliente-cep'];
            $cliente->rua = $dados['cliente-rua'];
            $cliente->numero = $dados['cliente-numero'];
            $cliente->bairro = $dados['cliente-bairro'];
            $cliente->cidade = $dados['cliente-cidade'];
            $cliente->uf = $dados['cliente-uf'];
            $cliente->observacao = $dados['cliente-observacao'];
            $cliente->save();

            foreach($cliente->contatos()->get() as $i => $contato){
                $tipo = TipoContato::where('tipo', $dados['cliente-tipo-contato'][$i])->first();
                $contato->id_cliente = $cliente->id;
                $contato->id_tipo_contato = $tipo->id;
                $contato->numero = $dados['cliente-contato'][$i];
                $contato->descricao = 'update';
                $cliente->contatos()->save($contato);
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
            $cliente = Cliente::find($request->get('clienteId'));
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

    private function findAllTipoContato(){
        return TipoContato::all();
    }

    private function find($id){
        return Cliente::where('id', $id)->with('contatos')->first();
    }
}
