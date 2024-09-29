<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test()
    {
        $repository=$this->app->make(SeriesRepository::class);
        $request=new SeriesFormRequest();
        $request->nome='Begave';
        $request->seasonsQty=1;
        $request->episodesPerSeason=1;

        $repository->add($request);

        $this->assertDatabaseHas('series',['nome'=>'Begave']);
        $this->assertDatabaseHas('seasons',['number'=>1]);
        $this->assertDatabaseHas('episodes',['number'=>1]);
    }
}
