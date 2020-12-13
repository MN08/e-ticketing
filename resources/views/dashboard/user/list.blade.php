@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-9 align-self-center">
                <h3>Users</h3>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Edited</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ ($users->currentPage()-1)*($users->perPage()) + $loop->iteration }}</th>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                        <td>{{ $user['updated_at'] }}</td>
                        <td><a href="{{ route('dashboard.users.edit', ['id' => $user->id]) }}" class="btn btn-secondary btn-sm"><b class="fas fa-edit"></b> Edit</a></td>
                        <td><form action="{{ route('dashboard.users.delete',['id'=>$user->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('are you sure?')"><b class="fas fa-trash"></b> Delete</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->appends($request)->links() }}
    </div>
</div>
@endsection
