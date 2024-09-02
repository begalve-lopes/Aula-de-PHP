@component('mail::message')
    # Nova Série Criada

    A série {{ $nomeSerie }} foi criada com sucesso!

    - Temporada: {{ $seasonsQty }}
    - Episódios: {{ $episodesPerSeason }}


    @component('mail::button', ['url' => route('seasons.index',$serieId)])
        Ver Série
    @endcomponent


@endcomponent
