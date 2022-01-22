@extends('layout')

@section('content')
<style>
    .form-error {
        border: 1px solid red;
    }
</style>

    <div class="container">
        <div>
            <a href="/posts" class="btn btn-secondary">Back</a>
        </div><br>
        <div class="card border-dark mb-3" style="max-width: 100rem;">
            <div class="card-header" style="text-align:center">
                Edit Post
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/posts/{{$post->id}}" method="post">
                    @csrf
                    @method('PUT') 
                    <div class="form-group">
                        <label for="exampleInputEmail">Name</label>
                        <input value="{{ old('name', $post->name) }}" type="text" class="form-control{{($errors->first('name') ? " form-error" : "")}}" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Description</label>
                        <textarea class="form-control{{($errors->first('description') ? " form-error" : "")}}" name="description" placeholder="Enter description">{{ old('description', $post->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <select name="category_id" id="" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $post->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection 