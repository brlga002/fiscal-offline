<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('codigo_interno');
            $table->string('codigo_interno_pessoa_fisica_juridica');
            $table->string('contas_a_receber_ano');
            $table->string('contas_a_receber_data_da_divida_ativa');
            $table->string('contas_a_receber_data_geracao');
            $table->string('contas_a_receber_data_pagamento');
            $table->string('contas_a_receber_data_protesto');
            $table->string('contas_a_receber_livro_da_divida_ativa');
            $table->string('contas_a_receber_pagina_da_divida_ativa');
            $table->string('contas_a_receber_parcelado');
            $table->string('contas_a_receber_somente_negociacao');
            $table->string('contas_a_receber_tipo_debito');
            $table->string('contas_a_receber_valor_atualizacao_monetaria');
            $table->string('contas_a_receber_valor_desconto');
            $table->string('contas_a_receber_valor_juros');
            $table->string('contas_a_receber_valor_multa');
            $table->string('contas_a_receber_valor_original');
            $table->string('contas_a_receber_valor_pago');
            $table->string('contas_a_receber_vencimento');
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
        Schema::dropIfExists('debits');
    }
}
