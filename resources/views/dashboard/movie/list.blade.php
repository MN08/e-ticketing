@extends('layouts.dashboard')

@section('content')
<div class="mb-2">
    <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary btn-sm"><b class="fas fa-plus"></b> Movies</a>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-9 align-self-center">
                <h3>Movies</h3>
            </div>
            <div class="col-md-3">
                <form action="{{ route('dashboard.movies') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="search" value="{{ $request['search'] ?? ''}}">
                        <div class="input-group-append">
                            <button class="btn btn-info btn-sm" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if ($movies->total())

        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    {{-- <th>#</th> --}}
                        <th class="text-center">Thumbnail</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Created</th>
                        <th class="text-center">Edited</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        {{-- <th scope="row">{{ ($movies->currentPage()-1)*($movies->perPage()) + $loop->iteration }}</th> --}}
                        <td class="col-thumbnail">
                            <img src="{{ asset('storage/movies/'.$movie['thumbnail']) }}" alt="" class="img-fluid"></td>
                        <td>{{ $movie['title'] }}</td>
                        <td>{{ $movie['created_at'] }}</td>
                        <td>{{ $movie['updated_at'] }}</td>
                        <td><a href="{{ route('dashboard.movies.edit',$movie->id) }}" class="btn btn-secondary btn-sm"><b class="fas fa-edit"></b> Edit</a></td>
                        <td><form action="{{ route('dashboard.movies.delete',['id'=>$movie->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('are you sure?')"><b class="fas fa-trash"></b> Delete</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $movies->appends($request)->links() }}

        @else
        <h4 class="text-center p-3">Movies Not Found</h4>

        @endif
    </div>
</div>
@endsection
