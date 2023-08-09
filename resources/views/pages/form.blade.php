@extends('layouts.basic')
@section('title', $title)

@section('content')
    <form class="container py-4">
        <div class="form-group">
            <label for="code">Código</label>
            <input type="text" class="form-control" id="code" placeholder="Insira o Código do Animal">
        </div>
        <div class="form-group">
            <label for="milk">Leite</label>
            <input type="text" class="form-control" id="milk" placeholder="Insira a Produção de Leite Semanal do Animal">
        </div>
        <div class="form-group">
            <label for="food">Ração</label>
            <input type="text" class="form-control" id="food" placeholder="Insira o Consumo de Ração Semanal do Animal">
        </div>
        <div class="form-group">
            <label for="weight">Peso</label>
            <input type="text" class="form-control" id="weight" placeholder="Insira o Peso do Animal (Kg)">
        </div>
        <div class="form-group">
            <label for="born">Nascimento</label>
            <input type="text" class="form-control" id="born" placeholder="Insira a Data de Nascimento do Animal">
        </div>
        <div class="form-group">
            <button type="submit">Adicionar</button>
        </div>
    </form>
@endsection
