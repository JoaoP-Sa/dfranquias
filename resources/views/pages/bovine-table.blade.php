@extends('layouts.basic')

@section('title', $title)

@section('content')
    <section class="py-4">
        <div class="container">
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
    </section>
@endsection
