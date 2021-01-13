<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentoHasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_has_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_orcamento')->constrained('orcamentos');
            $table->foreignId('id_produto')->constrained('produtos');
            $table->integer('quantidade');
            $table->float('total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamento_has_produtos');
    }
}
