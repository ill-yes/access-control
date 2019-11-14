@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">User Management</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-1">
                        </div>
                        <div class="col-5">

                            <form action="{{ route("setUserPin") }}" method="post">
                                <div class="row">
                                    <div class="col-5">
                                        <label style="font-weight:bold;">User ID</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="userId" min="0" max="9999" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label style="font-weight:bold;">New Pin</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="newPin" min="0" max="9999" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5"></div>
                                    <div class="col-6">
                                        <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                                    </div>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </div>

                        <div class="col-1">
                        </div>

                        <div class="col-5">
                            <form action="{{ route("setAccountState") }}" method="post">
                                <div class="row">
                                    <div class="col-5">
                                        <label style="font-weight:bold;">User ID</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="userId" min="0" max="9999" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label style="font-weight:bold;">Account state</label>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control" name="accountState" required>
                                            <option>Enabled</option>
                                            <option>Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5"></div>
                                    <div class="col-6">
                                        <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                                    </div>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Users</div>
                <div class="card-body">
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
                            <tr{!! ($user->fails >= 3) ? ' class="text-danger"' : '' !!}>
                                <th scope="row">{{ $user->id }}</th>
                                <td><a href="{{ route('users.show', $user) }}"{!! ($user->fails >= 3) ? ' class="text-danger"' : '' !!}>{{ $user->name }}</a></td>
                                <td>{!! $user->last_seen ?: '<span class="text-muted">-/-</span>' !!}</td>
                                <td>{{ $user->admin }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
