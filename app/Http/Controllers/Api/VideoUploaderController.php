<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Video;
use App\Http\Requests\VideoUploaderRequest;
use App\Jobs\ConvertVideoForStreaming;

use Illuminate\Support\Facades\Storage;

class VideoUploaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $video = Video::where('processed',1)->get();
        return response()->json(
            [
                'data' => $video
            ],200
        );
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4,video/mpeg,video/x-matroska',
        ]);

        $path = str_random(16) . '.' . $request->video->getClientOriginalExtension();
        $request->video->storeAs('public', $path);

        $video = Video::create([
            'disk'          => 'public',
            'original_name' => $request->video->getClientOriginalName(),
            'path'          => $path,
            'title'         => $request->title,
        ]);

//        ConvertVideoForStreaming::dispatch($video);

        $this->dispatch(new ConvertVideoForStreaming($video));

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        else{
            return response()->json(
                [
                    'Message' => 'Video has been uploaded'
                ],200
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $video = Video::find($id);
        $downloadUrl = Storage::disk('downloadable_videos')->url($video->id . '.mp4');
        $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');
        return response()->json(    
            [
                'URL' => $downloadUrl,
                'stream' => $streamUrl
            ],200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
