<table class="table table-bordered">
    @if(count($bovinesList))
        <thead>
            <tr>
                <th>Código</th>
                <th>Leite</th>
                <th>Ração</th>
                <th>Peso</th>
                <th>Nascimento</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bovinesList as $bovine)
            <tr>
                <td>{{ $bovine['code'] }}</td>
                <td>{{ $bovine['milk'] }} L</td>
                <td>{{ $bovine['food'] }} kg</td>
                <td>{{ $bovine['weight'] }} Kg</td>
                <td>{{ $bovine['born'] }}</td>
                <td class="text-center">
                    <button class="btn btn-dark">
                        <a href="{{ route('edit', ['id' => $bovine['id']]) }}">Editar</a>
                    </button>
                    @if(Route::currentRouteName() === 'shoot-down-bovines')
                        <button class="btn btn-dark">
                            Abater
                        </button>
                    @endif
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Excluir
                    </button>
                </td>
            </tr>
        @endforeach
    @else
            <tr>
                <td colspan="6" class="text-center">Não há nada para ser exibido ainda.</td>
            </tr>
        </tbody>
    @endif
</table>
@component('layouts._partials.confirm-modal')
@endcomponent