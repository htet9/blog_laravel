<?php

namespace App\Models;

use App\Mail\PostStored;
use App\Mail\PostUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    protected static function booted()
    {
        // static::created(function ($post) {
        //     Mail::to(Auth::user()->email)->send(new PostStored($post));
        // });

        // static::updated(function ($post) {
        //     Mail::to(Auth::user()->email)->send(new PostUpdated($post));
        // });
    }
}
