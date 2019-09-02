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

                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <a class="btn btn-secondary" href="/category/{{$category->id}}">View/Edit/Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div>
                        <a href="/category/new" class="btn btn-secondary">Add New Category</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
