@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="panel-heading">
        <h2>Video Upload Form</h2>
    </div>
    <div class="div">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
     
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('save-video') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container" style="margin-top: 20px">
                <div class="row">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" placeholder="Title" aria-label="Title" name="title">
                    </div>
                </div>
            </div>
        
            <div class="container" style="margin-top: 10px">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="video" class="form-label">Upload Video</label>
                            <input class="form-control" type="file" name="video">
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection