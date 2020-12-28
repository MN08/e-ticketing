@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-9 align-self-center">
                <h3>Movies</h3>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{ route($url, $movie->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') ??
                        $movie->title ?? ''}}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Desctiption</label>
                        <textarea class="form-control" name="description" id=""  rows="3">{{ old('description') ??$movie->description ?? ''}}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <div class="custom-file">
                            <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                            <input class="custom-file-input" type="file" name="thumbnail" id="">
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <button type="button" class="btn btn-warning float-right" onclick="window.history.back()">Cancel</button>
                        <button class="btn btn-success" type="submit"><b class="fas fa-save"></b> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
