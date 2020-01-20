@extends('layouts.app')

@section('content')
    <script>
        function delete_submit() {
            if (confirm("Are you sure you want to delete this?")) {
                document.getElementById('delete_form').submit();
            }
        }
    </script>

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

                        <form method="POST" action="/category/{{$id}}" id="delete_form">
                            @method('DELETE')
                            @csrf
                        </form>

                        <form method="POST" action="/category/{{$id}}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="name"
                                       placeholder="Name of category (ex: Take off, hoser)"
                                       value="{{$category->name}}"
                                >
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" id="description" name="description"
                                       placeholder="Description of category (ex: Films about Canada)"
                                       value="{{$category->description}}"
                                >
                            </div>

                            <div>
                                @if ($id == 'new')
                                    <button type="submit" class="btn btn-primary">Add</button>
                                @else
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" onclick="delete_submit()" class="btn btn-danger">Delete
                                    </button>
                                @endif
                                <a href="/category" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>

                        @if ($id!=='new')
                            <hr>

                            <h4>Films in category:</h4>
                            <table class="table table-bordered">
                                @foreach ($category->reviews as $review)
                                    <tr>
                                        <td>{{$review->title}} {{$review->year}}</td>
                                        <td>
                                            <form method="POST" action="/category/{{$id}}/review/{{$review->id}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-secondary">Remove Film from
                                                    category
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <form method="POST" action="/category/{{$id}}/search">
                                @csrf
                                <label for="search">Search for film to add</label>
                                <input id="search" name="search">
                                <button class="btn btn-secondary">Search</button>
                            </form>
                            @if (isset($search_results))
                                @foreach ($search_results as $search_key=>$search_result)
                                    <h3>Matches by {{$search_key}}</h3>
                                    @foreach ($search_result as $review)
                                        <table class="table table-bordered">

                                            <tr>
                                                <td>{{$review->title}} {{$review->year}}</td>
                                                <td>{{$review->description_fulltext}}</td>
                                                <td>
                                                    <form method="POST"
                                                          action="/category/{{$id}}/review/{{$review->id}}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary">Add Film to
                                                            category
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    @endforeach
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
