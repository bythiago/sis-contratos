<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\TipoContato;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function novo(){
        return view('cliente.novo');
    }

    public function index()
    {
        // $cliente = new Cliente();
        // $cliente->nome = 'Thiago Vieira de Carvalho';
        // $cliente->cpf = '13087064719';
        // $cliente->nascimento = '06/10/1989';
        // $cliente->sexo = 'M';
        // $cliente->cep = '13087964719';
        // $cliente->rua = 'Rua Teodoro José da Silva';
        // $cliente->numero = 98;
        // $cliente->bairro = 'Nova Esperança';
        // $cliente->cidade = 'Barra Mansa';
        // $cliente->uf = 'RJ';
        // $cliente->observacao = 'observacao';
        // $cliente->save();

        // $contato = new Contato();
        // $contato->id_cliente = Cliente::find(1)->id;
        // $contato->id_tipo_contato = TipoContato::find(2)->id;
        // $contato->numero = '2433284042';
        // $contato->descricao = 'descricao';
        // $contato->save();

        // $tipoContato = new TipoContato();
        // $tipoContato->tipo = "celular";
        // $tipoContato->descricao = "Celular";

        // $tipoContato->save();
    }

    public function salvar(Request $request)
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

            $cliente->save();

        } catch(\Exception $exception){
            dd($exception->getMessage());
        }
    }

    public function lista()
    {
        $dados = [
            'readonly' => "readonly",
            'cliente' => Cliente::all()
        ];

        return view('cliente.lista', compact('dados'));
    }
}
