@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <form action="{{ route('professional.fileUpdate') }}" method="post" enctype="multipart/form-data" class="mt-4">
    @csrf	
    <h1>Selecione o arquivo de Profissionais</h1>
    <input type="file" name="file" accept=".xls">
    <button type="submit">Enviar</button>
</form>
@endsection