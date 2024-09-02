<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Season;
class EloquentEpisodiosRepository implements EpisodiosRepository {
    public function upt(Request $request,Season $season): Episode
    {
        return $episodes=DB::transaction(function () use ($request,$season){
            $watchedEpisodes = $request->episodes;
            $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
                $episode->watched = in_array($episode->id, $watchedEpisodes);
            });
            $season->push();
        });


    }
}
