<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaaeCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if(!session()->has('videoVisited'))
        {$this->updateViewer($event->video);}
        else{
            return false;
        }
    }
    public function updateViewer($video){
        $video -> viewer=$video -> viewer+1;$videoData=$video->save();
        session()->put('videoVisited', $video -> id);
    }
}
