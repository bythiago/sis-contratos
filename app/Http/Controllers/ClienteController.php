<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contato;
use App\Models\TipoContato;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function lista($id)
    {
        $dados = [
            'readonly' => "readonly",
            'cliente' => Cliente::find($id)->first()
        ];

        return $dados;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



        $dados = [
            'cliente' => Cliente::all()
        ];

        return view('home', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
