<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('img/icon.png') }}">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
        @yield('style-file')
        <title>Gestão Bovinos - @yield('title')</title>
    </head>
    <body>
        @include('layouts._partials.header')
        @yield('content')

        <script src="{{ asset('js/test.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
            const modalTitleEl = document.getElementById('modalTitle');
            const confirmModalEl = document.getElementById('confirmModal');

            const setModalInfo = (animalID, method, routeName = null) => {
                modalTitleEl.innerText = method === 'GET' ? 'Excluir' : 'Abater';

                confirmModalEl.method = method;
                confirmModalEl.action =
                    `${window.location.origin}/${animalID}/${method === 'GET' ? 'excluir' : 'abater'}-bovino${routeName ? '/'+routeName : ''}`;

                console.log(confirmModalEl);
            }
        </script>
    </body>
</html>
