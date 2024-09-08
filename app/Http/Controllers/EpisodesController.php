<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(Season $season,Request $request){
        return view('episodes.index',['episodes'=>$season->episodes,
        'mensagemSucesso'=>session('mensagem.Sucesso')
    ]);
    }

    public function update(Request $request,Season $season){
            $watchedEpisodes = $request->episodes;
            $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
                $episode->watched = in_array($episode->id, $watchedEpisodes);
            });
            $season->push();
            return to_route('episodes.index',$season->id)->with('mensagem.Sucesso','Episodeos marcado como assistido');
    }
}
