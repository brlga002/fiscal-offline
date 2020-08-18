@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 mt-4">Home</h1>
<p class="mb-4">Registros</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Registro</th>
                    <th>CPF/CNPJ</th>
                    <th>Categoria</th>
                    <th>Situação Registro</th>
                    <th>Situação Finaceira</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Registro</th>
                    <th>CPF/CNPJ</th>
                    <th>Categoria</th>
                    <th>Situação Registro</th>
                    <th>Situação Finaceira</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($professionals as $professional)
                    <tr class="{{ ($professional->situacao_financeira === 'INADIMPLENTE') ? 'table-danger' : '' }}">
                        <td><a href="{{ route('professional.show', ['professional' => $professional->id]) }}">{{ $professional->nome_razao_social }}</a></td>
                        <td>{{ $professional->registro }}</td>
                        <td>{{ $professional->cpf_cnpj }}</td>
                        <td>{{ $professional->categoria_profissional }}</td>
                        <td>{{ $professional->situacao_registro }}</td>
                        <td>{{ $professional->situacao_financeira }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection