<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function __construct(private EpisodiosRepository $repository){

    }
    public function index(Season $season,Request $request){
        return view('episodes.index',['episodes'=>$season->episodes,
        'mensagemSucesso'=>session('mensagem.Sucesso')
    ]);
    }

    public function update(Request $request,Season $season){
        $episodes=$this->repository->upt($request,$season);
        return to_route('episodes.index',$season->id)->with('mensagem.Sucesso','Episodeos marcado como assistido');
    }
}
