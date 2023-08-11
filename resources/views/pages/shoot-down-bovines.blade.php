@extends('layouts.basic')

@section('title', $title)

@section('style-file')
    <link rel="stylesheet" href="{{ asset('css/views/shoot-down-bovines.css') }}">
@endsection

@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action active"
                                data-bs-toggle="tab"
                                data-bs-target="#shoot-bovines"
                                type="button"
                            >
                                Animais Para Abate
                        </button>
                        <button class="list-group-item list-group-item-action"
                                data-bs-toggle="tab"
                                data-bs-target="#shoot-bovines-report"
                                type="button"
                        >
                                Animais Abatidos
                        </button>
                    </div>
                </div>
                <div id="shoot-bovines" class="col-md-9 active show tab">
                    @component('layouts._partials.table', ['bovinesList' => $bovinesList])
                    @endcomponent

                    {{-- <h2 id="shoot-bovines" aria-labelledby="shoot-bovines-tab" class="active show">1</h2>
                    <h2 id="shoot-bovines-report" aria-labelledby="shoot-bovines-report-tab">2</h2> --}}
                </div>

                <div id="shoot-bovines-report" class="col-md-9 tab">
                    <h2>relatorio</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
