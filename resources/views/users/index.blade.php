@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Benutzer</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Zuletzt gesehen</th>
                        <th scope="col">Administrator</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></td>
                            <td>{!! $user->last_seen ?: '<span class="text-muted">-/-</span>' !!}</td>
                            <td>{{ $user->admin }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
