@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-9 align-self-center">
                <h3>Movies</h3>
            </div>
            <div class="col-md-3">
                <form action="{{ route('dashboard.users') }}" method="get">
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
        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <th scope="row">{{ ($movies->currentPage()-1)*($movie->perPage()) + $loop->iteration }}</th>
                        <td>{{ $movie['title'] }}</td>
                        <td>{{ $movie['thumbnail'] }}</td>
                        <td><a href="{{ route('dashboard.movies.edit', ['id' => $movie->id]) }}" class="btn btn-secondary btn-sm"><b class="fas fa-edit"></b> Edit</a></td>
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
    </div>
</div>
@endsection
