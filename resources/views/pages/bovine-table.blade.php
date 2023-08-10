@extends('layouts.basic')

@section('title', $title)

@section('style-file')
    <link rel="stylesheet" href="{{ asset('css/views/bovine-table.css') }}">
@endsection

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                @if($route !== 'all-bovines')
                    <div class="col-md-3">
                        <div class="list-group">
                            <button class="list-group-item list-group-item-action active">
                            Lista
                            </button>
                            <button class="list-group-item list-group-item-action">Relatório</button>
                        </div>
                    </div>
                @endif
                <div class="{{ $route !== 'all-bovines' ? 'col-md-9' : 'col-md-12' }}">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Leite</th>
                                <th>Ração</th>
                                <th>Peso</th>
                                <th>Nascimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0001</td>
                                <td>200 L</td>
                                <td>500kg</td>
                                <td>15000 kg</td>
                                <td>01/01/2010</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
