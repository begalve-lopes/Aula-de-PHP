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

    public function update($id, SeriesFormRequest $request)
    {
        $series=Serie::find($id);
        DB::beginTransaction();
            $series->update($request->all());
            $series->seasons->update($request->all());
            $series->episodes->update($request->all());
        DB::commit();
        return to_route('series.index')->with('mensagem.Sucesso', "Série {$series->nome} atualizado com sucesso! ");
    }
}
