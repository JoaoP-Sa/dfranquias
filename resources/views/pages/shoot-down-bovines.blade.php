@extends('layouts.basic', [
    'introTitle' => $title,
    'introDescription' => 'Abaixo encontram-se duas telas: a primeira com uma tabela com todos os
                          animais que se encaixam em algum dos critério de abate descritos acima dela,
                          e a segunda com uma tabela que lista todos os animais que foram abatidos
                          junto a um relatório com as informações gerais destes animais.'
])

@section('title', $title)

@section('style-file')
    <link rel="stylesheet" href="{{ asset('css/views/shoot-down-bovines.css') }}">
@endsection

@section('content')
    <section class="pb-4">
                <div class="row text-center">
                    <div class="list-group d-flex flex-row">
                        <button class="list-group-item list-group-item-action text-center active"
                                data-bs-toggle="tab"
                                data-bs-target="#shoot-bovines"
                                type="button"
                            >
                                Animais Para Abate
                        </button>
                        <button class="list-group-item list-group-item-action text-center"
                                data-bs-toggle="tab"
                                data-bs-target="#shoot-bovines-report"
                                type="button"
                        >
                                Animais Abatidos
                        </button>
                    </div>
                </div>

                <div class="container py-4">
                    <div id="shoot-bovines" class="active show tab">
                        <p>
                            Abaixo temos uma tabela que exibe os animais que podem ser abatidos.
                            Os animais listados atendem ao algum dos seguintes critérios de abate:

                            <ul>
                                <li>Possui mais de 5 anos de idade</li>
                                <li>Produz menos de 40 litros de leite por semana</li>
                                <li>Produz menos de 70 litros de leite por semana e ingere mais de
                                    50 quilos de ração por dia (totalizando mais de 350 quilos por
                                    semana)</li>
                            </ul>
                        </p>

                        @include('layouts._partials.table', ['bovinesList' => $aliveBovinesListToShootDown, 'shootDown' => true])
                    </div>

                    <div id="shoot-bovines-report" class="tab">
                        <p>
                            Abaixo temos uma tabela que exibe os animais que já foram abatidos.
                            Os animais listados atendiam ao algum dos critérios mencionados na
                            tela anterior.
                        </p>

                        @include('layouts._partials.table', ['bovinesList' => $shootedDownBovinesList, 'shootedDown' => true])

                        <p>
                            Abaixo temos uma estimativa da quantidade total de carne obtida com o
                            abate dos animais listados acima com base no peso de todos os animais
                            inteiros e no rendimento estimado da carcaça, que varia aproximadamente
                            entre 48% a 62% do peso do animal inteiro:

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Peso Total dos Animais Vivos</td>
                                        <td>{{ $allShootedDownBovinesWeight }} Kg</td>
                                    </tr>
                                    <tr>
                                        <td>Peso Máximo Total da Carcaça</td>
                                        <td>{{ $allShootedDownBovinesWeight * 0.62 }} Kg</td>
                                    </tr>
                                    <tr>
                                        <td>Peso Mínimo Total da Carcaça</td>
                                        <td>{{ $allShootedDownBovinesWeight * 0.48 }} Kg</td>
                                    </tr>
                                </tbody>
                            </table>
                        </p>
                    </div>
                </div>

        @include('layouts._partials.confirm-modal')
    </section>
@endsection
