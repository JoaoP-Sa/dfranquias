<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('img/icon.png') }}">

        {{-- fontawesome css --}}
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet"/>

        {{-- bootstrap css --}}
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>

        {{-- global css --}}
        <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>

        {{-- specific screen css --}}
        @yield('style-file')

        <title>Gestão Bovinos - @yield('title')</title>
    </head>
    <body>
        @include('layouts._partials.header')
        @component('layouts._partials.page-intro')
            <h1>{{ $introTitle }}</h1>

            @if($introDescription)
                <p>{{ $introDescription }}</p>
            @endif
        @endcomponent
        @yield('content')

        {{-- fontawesome js --}}
        <script src="{{ asset('js/all.min.js') }}"></script>

        {{-- bootstrap js --}}
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        {{-- jquery e jquery-mask --}}
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/jquery.mask.js') }}"></script>

        <script>
            const modalTitleEl = document.getElementById('modalTitle');
            const confirmModalEl = document.getElementById('confirmModal');

            const setModalInfo = (animalID, method, routeName = null) => {
                modalTitleEl.innerText = method === 'GET' ? 'Excluir' : 'Abater';

                confirmModalEl.method = method;
                confirmModalEl.action =
                    `${window.location.origin}/${animalID}/${method === 'GET' ? 'excluir' : 'abater'}-bovino${routeName ? '/'+routeName : ''}`;
            }
        </script>
    </body>
</html>
