<?php

namespace App\Http\Controllers\Streams;

use App\Models\Level;
use App\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\StreamResource;

class StreamController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vans['stream'] = Stream::all();
        // $vans['level'] = Level::all();
        $vans = StreamResource::collection(Stream::latest()->get());
        // return $this->showAll($vans);
        return $vans;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $this->validate($request, $rules);
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
        ];
        $van = Stream::create($data);

        $levels = $request->levels;
        if ($request->levels == null) {
            $levels = [];
        }
        $van->levels()->attach($levels);
        return $this->showOne($van, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function show(Stream $stream)
    {
        return new StreamResource($stream);
        // return $this->showOne($stream);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stream $stream)
    {
        if ($request->has('name')) {
            $stream->name = $request->name;
        }
        if ($request->has('description')) {
            $stream->description = $request->description;
        }

        if (!$stream->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }
        $stream->update();
        return $this->showOne($stream);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stream $stream)
    {
        $stream->delete();
        return $this->showOne($stream);
    }
}
