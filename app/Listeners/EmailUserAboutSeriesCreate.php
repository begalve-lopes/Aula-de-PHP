<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutSeriesCreate implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreated $event): void
    {
        $SerieList=User::all();
        foreach ($SerieList as $index=>$user) {
            $email=new \App\Mail\SeriesCreated(
                $event->SeriesNome,
                $event->SeriesId,
                $event->SeriesSeansonsQty,
                $event->SeriesEpisodesPerSeanson,
            );
            $when=now()->addSeconds($index*2);
            Mail::to($user)->later($when,$email);
        }
    }
}
