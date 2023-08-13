@php
    $previousValues = Session::get('previous_values');
    $previousAnimalID = Session::get('animal_id');

    $checkIfIsRegisterForm = (!isset($animal) || !$animal) && !$previousAnimalID;
@endphp

@extends('layouts.basic', [
    'introTitle' => ($checkIfIsRegisterForm ? 'Cadastrar' : 'Editar').' Animal',
    'introDescription' => null
])
@section('title', $title)

@section('content')
    {{ $msg }}
    <form class="container py-4"
          method="POST"
          action="{{ $checkIfIsRegisterForm
                        ? route('register')
                        : route('edit', ['id' => $animal ?? $previousAnimalID]) }}"
        >
        @csrf

        @if((isset($animal) && $animal) || isset($previousAnimalID))
            @method('PUT')
        @endif

        <div class="form-group pb-2">
            <label for="code"><span class="danger">*</span>Código</label>
            <input type="text"
                   class="form-control"
                   id="code"
                   name="code"
                   placeholder="Insira o Código do Animal"
                   value="{{ old('code') ?? $animalInfo->code ?? $previousValues['code'] ?? '' }}"
                   >
            <span class="danger">{{ $errors->first('code') ?? '' }}</span>
        </div>
        <div class="form-group py-2">
            <label for="milk">Leite</label>
            <input type="text"
                   class="form-control"
                   id="milk"
                   name="milk"
                   placeholder="Insira a Produção de Leite Semanal do Animal"
                   value="{{ old('milk') ?? $animalInfo->milk ?? $previousValues['milk'] ?? '' }}"
                   >
            <span class="danger">{{ $errors->first('milk') ?? '' }}</span>
        </div>
        <div class="form-group py-2">
            <label for="food">Ração</label>
            <input type="text"
                   class="form-control"
                   id="food"
                   name="food"
                   placeholder="Insira o Consumo de Ração Semanal do Animal"
                   value="{{ old('food') ?? $animalInfo->food ?? $previousValues['food'] ?? '' }}"
                   >
            <span class="danger">{{ $errors->first('food') ?? '' }}</span>
        </div>
        <div class="form-group py-2">
            <label for="weight"><span class="danger">*</span>Peso</label>
            <input type="text"
                   class="form-control"
                   id="weight"
                   name="weight"
                   placeholder="Insira o Peso do Animal (Kg)"
                   value="{{ old('weight') ?? $animalInfo->weight ?? $previousValues['weight'] ?? '' }}"
                   >
            <span class="danger">{{ $errors->first('weight') ?? '' }}</span>
        </div>
        <div class="form-group py-2">
            <label for="born"><span class="danger">*</span>Nascimento</label>
            <input type="text"
                   class="form-control"
                   id="born"
                   name="born" placeholder="dd/mm/YYYY"
                   value="{{ old('born') ?? $animalInfo->born ?? $previousValues['born'] ?? '' }}"
                   >
            <span class="danger">{{ $errors->first('born') ?? '' }}</span>
        </div>
        <div class="form-group pt-2">
            <button class="btn btn-success w-100" type="submit">{{ $buttonText }}</button>
        </div>
    </form>
@endsection
