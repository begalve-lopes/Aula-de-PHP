<x-layouts title="Temporadas {!! $series->nome !!}">
    <div class="d-flex justify-content-center">
       @if($series->cover)
            <img src="{{ asset('storage/' . $series->cover ) }}" style="height: 400px"
                 class="img-fluid ">
       @endif
    </div>
    <ul class="list-group ">
       @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index',$season->id) }}">Temporadas {{ $season->number}}</a>

                <span class="badge bg-secondary">
                    {{ $season->numberOfWatchedEpisodes() }}/{{ $season->episodes->count() }}
                </span>
            </li>
       @endforeach
    </ul>
</x-layouts>
