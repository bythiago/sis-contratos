<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_contrato')->constrained('contratos');
            $table->foreignId('id_orcamento')->constrained('orcamentos');
            $table->foreignId('id_cliente')->constrained('clientes');
            $table->foreignId('id_anotacao')->constrained('anotacoes');
            $table->foreignId('id_status')->constrained('status');
            $table->boolean('status');
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
        Schema::dropIfExists('controles');
    }
}
