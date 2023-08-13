@php
    $title = 'Início';
@endphp

@extends('layouts.basic', [
    'introTitle' => $title,
    'introDescription' =>
            'O Gestão Bovinos é um sistema que possui a finalidade de gerenciar os animais
            da sua criação. Neste sistema é possível cadastrar novos animais, atualizar
            as informações de algum bovino já cadastrado, excluir o animal do sistema,
            visualizar todos os animais vivos e abatidos cadastrados, e enviar algum animal
            para abate caso ele atenda os requisitos necessários para isso.'
])

@section('title', $title)

@section('style-file')
    <link href="{{ asset('css/views/home.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <section>
        <div class="container py-4">
            <p>
                Abaixo apresentamos uma pequena tabela que exibe dados referentes a produção de
                leite, consumo de ração, e ao total de animais jovens que consomem mais de 500Kg
                de ração. É importante ressaltar que os dados listados são referentes ao período de
                uma semana, e atendem aos seguintes critérios:

                <ul>
                    <li>Quantidade total de leite produzido por semana</li>
                    <li>Quantidade total de ração necessária por semana</li>
                    <li>Quantidade total de animais que tenham até 1 ano de idade e que
                        consumam mais de 500Kg de ração por semana</li>
                </ul>
            </p>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Produção Semanal de Leite</td>
                        <td>{{ $milkTotal }} L</td>
                    </tr>
                    <tr>
                        <td>Consumo Semanal de Ração</td>
                        <td>{{ $necessaryFoodTotal }} Kg</td>
                    </tr>
                    <tr>
                        <td>Animais Jovens Com Maior Consumo Semanal de Ração</td>
                        <td>{{ $youngHungryAnimals }} Unid.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="bg-dark text-white py-3">
        <div class="container">
            <p>
                Os dados exibidos acima são alterados automaticamente ao ser realizada
                qualquer alteração ou mesmo exclusão em algum animal cadastrado no sistema. Vale
                ressaltar que no sistema todos os dados quantitativos são semanais, ou seja, as
                quantidades são baseadas no intervalo de uma semana, Ex: Quantia de ração consumida
                por semana, Quantia de leite produzida por semana, etc.
            </p>
        </div>
    </section>
@endsection
