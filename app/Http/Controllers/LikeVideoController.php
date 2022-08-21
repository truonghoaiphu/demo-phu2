<?php

namespace App\Http\Controllers;

use App\Models\LikeVideo;
use Illuminate\Http\Request;

class LikeVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function react(Request $request)
    {
        $attributes = [
            'reaction' => $request->get('reaction'),
            'user_id' => $request->get('user_id'),
            'share_video_id' => $request->get('share_video_id'),
        ];

        $newRecord = new LikeVideo();
        $newRecord->user_id = $attributes['user_id'];
        $newRecord->reaction = $attributes['reaction'];
        $newRecord->share_video_id = $attributes['share_video_id'];

        $result = $newRecord->save();

        if (!$result) {
            return back()->withErrors('Cannot React video');
        }

        return redirect('/')->with('message', 'Success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LikeVideo  $likeVideo
     * @return \Illuminate\Http\Response
     */
    public function show(LikeVideo $likeVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LikeVideo  $likeVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(LikeVideo $likeVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LikeVideo  $likeVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LikeVideo $likeVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LikeVideo  $likeVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(LikeVideo $likeVideo)
    {
        //
    }
}
