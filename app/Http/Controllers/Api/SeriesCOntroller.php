<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesCOntroller extends Controller
{
    public function __construct(private SeriesRepository $Seriesrepository){}

    public function index(){
        return Serie::all();
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

    public function destroy(int $series){
        Serie::destroy($series);
        return response()->noContent();
    }
}
