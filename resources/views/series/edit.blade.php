<x-layouts title="Criar-Series {{ $serie->nome }}">
    <form action="{{ route('series.update',$serie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text"
                name="nome"
                id="nome"
                class="form-control"
                    value="{{old('nome') ?? $serie->nome }}"
                >
            </div>

            <div class="col-2">
                <label for="seansonsQty" class="form-label">Nº Temporadas :</label>
                <input type="number"
                name="seansonsQty"
                id="seansonsQty"
                class="form-control"
                    value="{{old('seansonsQty') ?? $serie->seasons->count()}}"
                >
            </div>

            <div class="col-2">
                <label for="episodesPerSeanson" class="form-label">Eps / Temporadas :</label>
                <input type="number"
                name="episodesPerSeanson"
                id="episodesPerSeanson"
                class="form-control"
                    
                >
            </div>
        </div>

        <div class=" row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Cover</label>
                <input type="file"
                name="cover"
                id="cover"
                class="form-control"
                >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</x-layouts>
