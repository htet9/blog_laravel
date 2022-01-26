@extends('layout')

@section('content')
    <div class="container">
        <div>
            <a href="/posts/create" class="btn btn-success">Create</a>
            <h5 style="float:right">{{ Auth::user()->name }}</h5>
        </div><br>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('status') }}
            </div>
        @endif
        <div class="card border-dark mb-3" style="max-width: 100rem;">
            <div class="card-header" style="text-align:center">
                Contents
            </div>
            <div class="card-body">
                @foreach($data as $post)
                    <div>
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->description}}</p>
                        <div class="form-row">
                            <a style="height:38px; margin-right:8px" href="/posts/{{ $post->id }}" class="btn btn-info">Read more</a>
                            <a style="height:38px; margin-right:8px" href="/posts/{{ $post->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/posts/{{$post->id}}" method="post">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div><hr>
                @endforeach
                <a href="/logout" style="float:right" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
@endsection 