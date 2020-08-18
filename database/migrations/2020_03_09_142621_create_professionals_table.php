<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('capital_social');
            $table->string('categoria_profissional');
            $table->string('codigo_interno');
            $table->string('cpf_cnpj');
            $table->string('data_nascimento');
            $table->string('email');
            $table->string('endereco');
            $table->string('endereco_bairro');
            $table->string('endereco_cep');
            $table->string('endereco_cidade');
            $table->string('endereco_estado');
            $table->string('naturalidade');
            $table->string('nome_razao_social');
            $table->string('registro');
            $table->string('sexo');
            $table->string('situacao_financeira');
            $table->string('situacao_registro');
            $table->string('telefone');
            $table->string('tipo_pessoa');
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
        Schema::dropIfExists('professionals');
    }
}
