<?php

namespace App\Repositories;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;
use App\Models\Episode;
use App\Models\Season;

class EloquentSeriesRepository implements SeriesRepository{

    public function add(SeriesFormRequest $request): Serie
    {
        return $series=DB::transaction(function() use ($request){
            $series= Serie::create([
                'nome'=>$request->nome,
                'cover'=>$request->coverPath
            ]);
            $season=[];
            for ($s=1; $s <= $request->seansonsQty ; $s++) {
                $season[]=[
                    'series_id'=>$series->id,
                    'number'=>$s,
                ];
            }
            Season::insert($season);

            $episode=[];

            foreach ($series->seasons as $season) {
                for ($e=1; $e <= $request->episodesPerSeanson ; $e++) {
                    $episode[]=[
                        'season_id'=>$season->id,
                        'number'=>$e,
                    ];
                }
            }
            Episode::insert($episode);
            return $series;
        });

    }
}
