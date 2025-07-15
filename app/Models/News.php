<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- 1. TAMBAHKAN INI

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug', 
        'content',
        'image',
        'author',
        'status',
        'published_at',

    ];

    /**
     * 3. TAMBAHKAN METHOD boot() DI BAWAH INI
     * Ini akan membuat slug secara otomatis dari judul.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }

    /**
     * 4. TAMBAHKAN METHOD INI
     * Ini akan mengubah kunci pencarian dari 'id' ke 'slug'.
     */
    public function getRouteKeyName()
    {
        return 'slug';
 
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }
}