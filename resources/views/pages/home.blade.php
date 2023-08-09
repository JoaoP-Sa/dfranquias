@extends('layouts.basic')
@section('title', 'Início')

@section('style-file')
    <link href="{{ asset('css/views/home.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <section class="py-4">
        <div class="container">
            <p>
                Nesta seção, apresentamos uma tabela que exibe dados referentes a produção de
                leite, consumo de ração, e ao total de animais jovens que consomem mais de 500Kg
                de ração. Os dados exibidos atendem aos seguintes critérios:

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
                        <td>200 L</td>
                    </tr>
                    <tr>
                        <td>Consumo Semanal de Ração</td>
                        <td>10.000 Kg</td>
                    </tr>
                    <tr>
                        <td>Animais Jovens Com Maior Consumo Semanal de Ração</td>
                        <td>50 Unid.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
