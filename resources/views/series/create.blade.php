<x-layouts title="Criar-Series ">
    <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                    value="{{old('seansonsQty') }}"
                >
            </div>

            <div class="col-2">
                <label for="episodesPerSeanson" class="form-label">Eps / Temporadas :</label>
                <input type="episodesPerSeanson"
                name="episodesPerSeanson"
                id="episodesPerSeanson"
                class="form-control"
                    value="{{old('episodesPerSeanson') }}"
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
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layouts>
