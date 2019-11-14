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

                    <div class="row">
                        <div class="col-5">

                            <div class="row">
                                <div class="col-5">
                                    <label style="font-weight:bold;">Name:</label>
                                </div>
                                <div class="col-6">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-5">
                                    <label style="font-weight:bold;">eMail:</label>
                                </div>
                                <div class="col-6">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-5">
                                    <label style="font-weight:bold;">Pin:</label>
                                </div>
                                <div class="col-6">
                                    {{ $user->pin ?? "No pin set" }}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-5">
                                    <label style="font-weight:bold;">Card Number:</label>
                                </div>
                                <div class="col-6">
                                    {{ $user->card_number ?? "No card set"}}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-5">
                                    <label style="font-weight:bold;">Last seen:</label>
                                </div>
                                <div class="col-6">
                                    {{ $user->last_seen ?? "This is your first login" }}
                                </div>
                            </div>
                            <hr/>

                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <form action="{{ route("setPin") }}" method="post">
                                <div class="row">
                                    <div class="col-5">
                                        <label style="font-weight:bold;">New Pin:</label>
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
                            <hr/>
                        </div>

                    </div>
            </div>
        </div>
    </div>
@endsection
