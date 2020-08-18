@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<h1 class="h3 mb-2 text-gray-800 mt-4">Profissional</h1>
<p class="mb-4">Cadastro</p>

<p>NOME: {{ $professional->nome_razao_social }}</p>
<p>REGISTRO: {{ $professional->registro }}</p>
<p>CPF/CNPJ: {{ $professional->cpf_cnpj }}</p>
<p>CATEGORIA: {{ $professional->categoria_profissional }}</p>
<p>SITUAÇÃO: {{ $professional->situacao_registro }}</p>
<p>FINANCEIRO: {{ $professional->situacao_financeira }}</p>
<p>TELEFONE: {{ $professional->telefone }}</p>
<p>ENDERECOEMAIL: {{ $professional->email }}</p>
<p>ENDEREÇO: {{ $professional->endereco }}</p>
<p>BAIRRO: {{ $professional->endereco_bairro }}</p>
<p>CEP: {{ $professional->endereco_cep }} {{ $professional->endereco_cidade }}/{{ $professional->endereco_estado }}</p>

<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ano</th>
                    <th>Tipo</th>
                    <th>Venc.</th>
                    <th>Vlr. Original</th>
                    <th>Atualiz.</th>
                    <th>Multa</th>
                    <th>Juros</th>
                    <th>Desc.</th>
                    <th>Dt. Pag.</th>
                    <th>Vlr. Pago</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Ano</th>
                    <th>Tipo</th>
                    <th>Venc.</th>
                    <th>Vlr. Original</th>
                    <th>Atualiz.</th>
                    <th>Multa</th>
                    <th>Juros</th>
                    <th>Desc.</th>
                    <th>Dt. Pag.</th>
                    <th>Vlr. Pago</th>                 
                </tr>
                </tfoot>
                <tbody>
                @foreach ($debits as $debit)
                    <tr class="{{ ($debit->contas_a_receber_parcelado === 'SIM') ? 'table-warning' : '' }}">
                        <td>{{ $debit->id }}</td>
                        <td>{{ $debit->codigo_interno }}</td>
                        <td>{{ $debit->contas_a_receber_ano }}</td>
                        <td>{{ $debit->contas_a_receber_tipo_debito }}</td>
                        <td>{{ $debit->contas_a_receber_vencimento }}</td>
                        <td>{{ $debit->contas_a_receber_valor_original }}</td>
                        <td>{{ $debit->contas_a_receber_valor_atualizacao_monetaria }}</td>
                        <td>{{ $debit->contas_a_receber_valor_multa }}</td>
                        <td>{{ $debit->contas_a_receber_valor_juros }}</td>
                        <td>{{ $debit->contas_a_receber_valor_desconto }}</td>
                        <td>{{ $debit->contas_a_receber_data_pagamento }}</td>
                        <td>{{ $debit->contas_a_receber_valor_pago }}</td>                        
                        <td>{{ $debit->contas_a_receber_somente_negociacao }}</td>                        
                        <td>{{ $debit->contas_a_receber_parcelado }}</td>                 

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection