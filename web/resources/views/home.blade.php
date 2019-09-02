@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        Welcome to That Movie Guy Trivia.
                        Make trivia categories, build games out of them, and play them at the table.
                    </div>

                    <ul>
                        <li><a href="/category">Make a category</a></li>
                        <li><a href="/game">Build or play a game</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
