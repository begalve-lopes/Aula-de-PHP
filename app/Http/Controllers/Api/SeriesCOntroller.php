<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Repositories\SeriesRepository;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class SeriesCOntroller extends Controller
{
    public function __construct(private SeriesRepository $Seriesrepository){}

    public function index(Request $request){
        $query=Serie::query();
        if($request->has('nome')){
            $query->whereNome($request->nome);
        }
        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request){
       return response()
       ->json($this->Seriesrepository->add($request));
    }

    public function show(int $series){
      $series=Serie::whereId($series)->with('seasons.episodes')->first();
      if($series==null){
        return response()->json(['message'=>'serie nao encotrada'],404);
      }
      return $series;
    }

    public function update(Serie $series,SeriesFormRequest $request){
        $series->fill($request->all());
        $series->save();
        return $series;
    }

    public function destroy(Serie $series,SeriesFormRequest $request){
        dd($request->user());
        if(!$series->delete($request->all())){
            return response()->json([
                'error'=>'Not found'
            ],HttpResponse::HTTP_NOT_FOUND);
        }
        return $series;
    }
}
