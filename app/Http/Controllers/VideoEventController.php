<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoEventController extends Controller
{
    protected function index()
    {
        $video = Video::first();
        event(new VideoViewer($video));
        return view('videoveiwer')->with('video',$video);
    }
}
