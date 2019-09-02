@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>
                        Here's where you'll be able to build and run a game - add players, track their scores, and
                        control which trivia categories are up for play right now.
                    </p>
                    <p>
                        This isn't quite built yet.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
