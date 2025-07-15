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

     public function getImageUrlAttribute()
    {
        // Jika kolom 'image' di database tidak kosong, gunakan gambar tersebut.
        if ($this->image) {
            // Cek apakah path gambar adalah path default atau dari storage
            if ($this->image === 'images/default-news.jpg') {
                return asset($this->image);
            }
            return asset('storage/' . $this->image);
        }

        // Jika kosong, kembalikan path ke gambar default.
        return asset('images/default-news.jpg');
    }
}