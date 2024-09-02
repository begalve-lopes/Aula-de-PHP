<x-layouts title="Temporada">

    @if (session()->has('mensagem.Sucesso'))
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endif

    <form method="POST">
        @csrf
        <ul class="list-group ">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episode {{ $episode->number}}
                    <input type="checkbox"
                        name="episodes[]"
                        value="{{ $episode->id }}"
                        @if ($episode->watched)
                            checked
                        @endif
                    >
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary mt-2 mb-2">Salvar</button>

    </form>
</x-layouts>
