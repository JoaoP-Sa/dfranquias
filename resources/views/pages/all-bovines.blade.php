@php
    $title = 'Todos os Animais';
@endphp

@extends('layouts.basic', [
    'introTitle' => $title,
    'introDescription' =>
            'Nesta seção apresentamos uma tabela que exibe todos os animais vivos cadastrados no
            sistema, e as opções de edição e exclusão de cada um deles.'
])

@section('title', $title)

@section('content')
    <div class="container py-4">
        @include('layouts._partials.table', ['bovinesList' => $bovinesList])
    </div>

    @include('layouts._partials.confirm-modal')
@endsection
