@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ URL('/uploadvideo')}}"> Upload New Video</a>
        </div>
    </div>
</div>

@foreach ($videos as $data)


<div class="container" style="margin-top: 10px">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title" aria-label="Title" name="title" value="{{ $data->title }}" readonly>
            </div>
            <div class="mb-3">
                <video width="320" height="240" controls src="/storage/{{$data->stream_path}}">
                </video>
            </div>
        </div>
    </div>
</div>      
@endforeach

@endsection