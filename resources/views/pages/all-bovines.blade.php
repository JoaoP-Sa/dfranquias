@extends('layouts.basic')

@section('title', $title)

@section('content')
    <div class="container py-4">
        <p class="pb-4">
            Nesta seção, apresentamos uma tabela que exibe todos os animais cadastrados no sistema, e as
            opções de edição e exclusão de cada um deles.
        </p>

        @component('layouts._partials.table', ['bovinesList' => $bovinesList])
        @endcomponent
    </div>

    @component('layouts._partials.confirm-modal')
    @endcomponent
@endsection
