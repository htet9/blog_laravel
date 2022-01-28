<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\PostStored;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\PostCreatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\PostCreatedNoti;
use App\Http\Requests\storePostRequest;
use Illuminate\Support\Facades\Notification;

class Homecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Notification::send(User::find(1), new PostCreatedNoti());
        // echo 'Noti sent';exit();
        $data = Post::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated + ['user_id'=>Auth::user()->id]);

        PostCreatedEvent::dispatch($post);

        return redirect('/posts')->with('status', config('mail.message.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(storePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);

        return redirect('/posts')->with('status', config('mail.message.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
}