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
    @if(isset($msg))
        <div class="alert alert-{{ $status }} text-center" role="alert">
            {{ $msg }}
        </div>
    @endif

    <form class="container py-4 my-4 bg-white rounded"
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
            <span data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  data-bs-html="true"
                  title="O código de cada animal deve ser <strong>ÚNICO</strong> e conter 2
                  letras e 4 números, Ex: aa1111"
                >
                <i class="fa-regular fa-circle-question cursor-pointer"></i>
            </span>
            <input type="text"
                   class="form-control"
                   id="code"
                   name="code"
                   placeholder="Insira o Código do Animal"
                   data-mask="AA0000"
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
                   placeholder="Insira a Produção de Leite Semanal"
                   data-mask="000"
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
                   placeholder="Insira o Consumo de Ração Semanal"
                   data-mask="000"
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
                   placeholder="Insira o Peso (Kg)"
                   data-mask="0000"
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
                   data-mask="00/00/0000"
                   value="{{ old('born') ?? $animalInfo->born ?? $previousValues['born'] ?? '' }}"
                   >
            <span class="danger">{{ $errors->first('born') ?? '' }}</span>
        </div>
        <div class="form-group pt-2">
            <button class="btn btn-success w-100" type="submit">{{ $buttonText }}</button>
        </div>
    </form>
@endsection
