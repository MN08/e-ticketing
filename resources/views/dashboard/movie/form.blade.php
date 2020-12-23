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
                <form action="{{ route('dashboard.movies.store') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" value="">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <button class="btn btn-success" type="submit"><b class="fas fa-save"></b> Simpan</button>
                        <button type="button" class="btn btn-warning float-right" onclick="window.history.back()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
