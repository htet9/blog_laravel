@extends('layout')

@section('content')
    <div class="container">
        <div>
            <a href="/posts" class="btn btn-dark">Back</a>
        </div><br>
        <div class="card border-dark mb-3" style="max-width: 100rem;">
            <div class="card-header" style="text-align:center">
                Contents
            </div>
            <div class="card-body">
                    <div>
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->description}}</p>
                        <p class="card-text" style="font-style:italic">{{ 'Category : ' . $post->categories->name}}</p>
                    </div><hr>
            </div>
        </div>
    </div>
@endsection 