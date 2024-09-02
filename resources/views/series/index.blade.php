<x-layouts title="Index-Series">
    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark mb-3">Adicionar</a>

    @endauth
    @if (session()->has('mensagem.Sucesso'))
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endif

    <ul class="list-group ">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @auth
                    <a href="{{ route('seasons.index',$serie->id) }}">
                @endauth

                {{ $serie->nome }}

                @auth
                    </a>
                @endauth

                @auth
                <span class="d-flex">
                    <a href="{{ route('series.edit',$serie->id) }}" class="btn btn-primary btn-sm">E</a>
                    <form action="{{ route('series.destroy',$serie->id) }}" method="POST" class="ms-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">X</button>
                    </form>
                </span>
                @endauth


        </li>
        @endforeach

    </ul>
</x-layouts>
