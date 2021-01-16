<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Orcamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $clientes;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cliente $clientes)
    {
        $this->middleware('auth');
        $this->clientes = $clientes;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $clientes = $this->clientesWithPedidos();
        $pedidos = $this->pedidosQuantidade($clientes);

        $maisVendidos = $this->produtoMaisVendido();

        $data = [
            'clientes' => $clientes->count(),
            'pedidos' => $pedidos->sum(),
            'produtosMaisVendidos' => $maisVendidos
        ];

        return view('home.index', compact('data'));
    }

    //--------------------------------------------------------------------------------//

    private function clientesWithPedidos(){
        return $this->clientes::with('pedidos')->get();
    }

    private function pedidosQuantidade($clientes){
        return $clientes->map(function ($item) {
            return $item->pedidos->count();
        });
    }

    private function produtoMaisVendido(){
        return DB::table('orcamentos', 'o')
            ->selectRaw('p.id, p.nome, p.descricao, op.total, sum(op.quantidade) quantidade')
            ->join('orcamento_has_produtos as op', 'op.id_orcamento', '=', 'o.id')
            ->join('produtos as p', 'p.id', '=', 'op.id_produto')
            ->groupBy('p.id', 'p.nome', 'p.descricao', 'op.total')
            ->orderByRaw('sum(op.quantidade) desc')
            ->limit(5)
            ->get();
    }

    //--------------------------------------------------------------------------------//
}
