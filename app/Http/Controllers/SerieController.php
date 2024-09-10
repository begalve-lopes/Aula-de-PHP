<?php

namespace App\Http\Controllers;
use Exception;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;
use App\Models\Episode;
use App\Models\Season;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Mail;

class SerieController extends Controller
{

    public function __construct(private SeriesRepository $repository){

    }

    public function index(SeriesFormRequest $request){
        $series=Serie::all();
        $mensagemSucesso=$request->session()->get('mensagem.Sucesso');
        return view ('series.index')->with('series',$series)->with('mensagemSucesso',$mensagemSucesso);
    }

    public function create(){
        return view ('series.create');
    }

    public function store(SeriesFormRequest $request){
        $coverPath = $request->hasFile('cover') ?
            $request->file('cover')
                ->store('series_cover', 'public'):null;
        $request->coverPath=$coverPath;
        $series=$this->repository->add($request);
        \App\Events\SeriesCreated::dispatch(
            $series->nome,
            $series->id,
            $request->seansonsQty,
            $request->episodesPerSeanson
        );
        return to_route('series.index')->with('mensagem.Sucesso',"Série {$request->nome} adicionada com sucesso!");
    }

    public function destroy(Serie $series){
        $series->delete();
        return to_route('series.index')->with('mensagem.Sucesso', "Série {$series->nome} removida com sucesso! ");
    }

    public function edit(Serie $series,SeriesFormRequest $request){
        return view('series.edit', ['serie' => $series]);
    }

    public function update( SeriesFormRequest $request, $id)
    {
        $serie = Serie::find($id);

        $serie->update([
            'nome' => $request->nome,
            'cover' => $request->coverPath,
        ]);

        // Atualiza as temporadas existentes
        $seasons = $serie->seasons;

        foreach ($seasons as $season) {
            $season->update([
                'number' => $season->number,
            ]);
        }

        // Cria novas temporadas se necessário
        for ($s = $seasons->count() + 1; $s <= $request->seansonsQty; $s++) {
            Season::create([
                'series_id' => $serie->id,
                'number' => $s,
            ]);
        }

        // Atualiza os episódios existentes
        $episodes = $serie->episodes;

        if (!isset($episodes) || empty($episodes)) {
            $episodes = Episode::where('season_id', $season->id)->get();
        } else {
            foreach ($episodes as $episode) {
                $episode->update([
                    'number' => $episode->number,
                ]);
            }
        }

        // Cria novos episódios se necessário
        foreach ($serie->seasons as $season) {
            for ($e = $season->episodes->count() + 1; $e <= $request->episodesPerSeanson; $e++) {
                $episode = Episode::create([
                    'number' =>$e,
                    'season_id' => $season->id, // substitua 1 pelo valor correto da season_id
                ]);
            }
        }

        return to_route('series.index')->with('mensagem.Sucesso', "Série {$serie->nome} atualizado com sucesso! ");
    }
}
