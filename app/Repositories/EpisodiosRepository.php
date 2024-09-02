<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Season;


interface EpisodiosRepository{
    public function upt(Request $request,Season $season): Episode;
}
