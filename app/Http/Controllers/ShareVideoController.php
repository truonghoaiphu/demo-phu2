<?php

namespace App\Http\Controllers;

use App\Models\ShareVideo;
use Illuminate\Http\Request;
use App\Http\Requests\ShareVideoRequest;
use Illuminate\Support\Facades\DB;

class ShareVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = ShareVideo::all();

        return view('home')->with('videos', $videos);;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShareVideoRequest $request)
    {
        $attributes = [
            'url' => $request->get('url'),
            'user_id' => $request->get('user_id'),
        ];
        $url = $attributes['url'];
        parse_str( parse_url( $url, PHP_URL_QUERY ), $url_array );
        $videoId = $url_array['v'];
        $apikey = 'AIzaSyC-Qdqui2FcvJOBPcpythuUS550bhKwAx4';

        $json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&key=' . $apikey . '&part=snippet');

        $data = json_decode($json, true);

        $title = $data['items'][0]['snippet']['title'];
        $description = $data['items'][0]['snippet']['description'];
        $thumbnail = $data['items'][0]['snippet']['thumbnails']['default']['url'];

        $shareVideo = new ShareVideo();
        $shareVideo->user_id = $attributes['user_id'];
        $shareVideo->url = $attributes['url'];
        $shareVideo->video_id = $videoId;
        $shareVideo->title = $title;
        $shareVideo->description = $description;
        $shareVideo->thumbnail = $thumbnail;

        $result = $shareVideo->save();

        if (!$result) {
            return back()->withErrors('Cannot save URL');
        }

        return redirect('/')->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShareVideo  $shareVideo
     * @return \Illuminate\Http\Response
     */
    public function show(ShareVideo $shareVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShareVideo  $shareVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(ShareVideo $shareVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShareVideo  $shareVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShareVideo $shareVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShareVideo  $shareVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShareVideo $shareVideo)
    {
        //
    }
}
