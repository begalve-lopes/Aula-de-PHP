<x-layouts title="Criar-Series {{ $serie->nome }}">
    <form action="{{ route('series.update',$serie->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text"
                name="nome"
                id="nome"
                class="form-control"
                    value="{{old('nome') }}"
                >
            </div>

            <div class="col-2">
                <label for="seansonsQty" class="form-label">Nº Temporadas :</label>
                <input type="seansonsQty"
                name="seansonsQty"
                id="seansonsQty"
                class="form-control"
                    value="{{old('seansonsQty')}}"
                >
            </div>

            <div class="col-2">
                <label for="episodesPerSeanson" class="form-label">Eps / Temporadas :</label>
                <input type="episodesPerSeanson"
                name="episodesPerSeanson"
                id="episodesPerSeanson"
                class="form-control"
                    value="{{old('episodesPerSeanson')}}"
                >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layouts>
