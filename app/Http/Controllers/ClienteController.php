<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;

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
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        try {

            $dados = [];
            parse_str($request->get('dados'), $dados);

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

            // $cliente->save();

        } catch(\Exception $exception){
            return [];
        }
    }

    public function show($id)
    {
        return view('cliente.show', [
                'cliente' => $this->find($id),
                'readonly' => true
            ]
        );
    }

    public function edit($id)
    {
        return view('cliente.show', [
                'cliente' => $this->find($id),
                'readonly' => false
            ]
        );
    }

    public function update(Request $request, $id){

        try {
            $dados = [];
            parse_str($request->get('dados'), $dados);
        
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

            return response()->json([
                'message' => "{$cliente->nome} foi alterado com sucesso"
            ], 200);

        } catch(\Exception $exception){
            return [];
        }

    }


    public function destroy(Request $request)
    {
        try {
            $cliente = Cliente::find($request->get('clienteId'));
            $cliente->delete();
            
            return response()->json([
                'message' => 'Cliente foi removido com sucesso'
            ], 200);
        } catch(\Exception $exception){
            return [];
        }
    }

    private function find($id){
        return Cliente::where('id', $id)->with('contatos')->first();
    }
}
