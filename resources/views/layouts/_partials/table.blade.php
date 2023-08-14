<div class="table-content">
    <table class="table table-bordered">
        @if(count($bovinesList))
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Leite</th>
                    <th>Ração</th>
                    <th>Peso</th>
                    <th>Nascimento</th>
                    @if(isset($shootedDown))
                        <th>Óbito</th>
                    @endif
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($bovinesList as $bovine)
                <tr>
                    <td>{{ $bovine->code }}</td>
                    <td>{{ $bovine->milk }} L</td>
                    <td>{{ $bovine->food }} kg</td>
                    <td>{{ $bovine->weight }} Kg</td>
                    <td>{{ date('d/m/Y',strtotime($bovine->born)) }}</td>
                    @if($bovine->shooted_down)
                        <td>{{ date('d/m/Y',strtotime($bovine->updated_at)) }}</td>
                    @endif
                    <td class="text-center">
                        @if(!$bovine->shooted_down)
                        <a href="{{ route('edit', ['id' => $bovine->id]) }}">
                            <button class="btn btn-primary text-white my-1">
                                Editar
                            </button>
                        </a>
                        @endif
                        @if(isset($shootDown))
                            <button type="button"
                                    class="btn btn-secondary my-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#actionModal"
                                    onclick="setModalInfo({{ $bovine->id }}, 'POST')"
                                    >
                                Abater
                            </button>
                        @endif
                        <button type="button"
                                class="btn btn-warning text-white my-1"
                                data-bs-toggle="modal"
                                data-bs-target="#actionModal"
                                onclick="setModalInfo({{ $bovine->id }},'GET', '{{ Route::currentRouteName() }}')"
                                >
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
</div>

<div class="table-pagination text-center">
    {{ $bovinesList->withQueryString()->onEachSide(1)->links() }}
</div>
