<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity; // <-- TAMBAHKAN INI
use Spatie\Activitylog\LogOptions;

class News extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'author', 'status'])
            ->setDescriptionForEvent(fn(string $eventName) => "Berita '{$this->title}' telah di-{$eventName}");
    }

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
     * ===============================================
     * TAMBAHKAN BLOK KODE INI
     * ===============================================
     * Beritahu Laravel bahwa kolom-kolom ini adalah tanggal.
     */
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // ===============================================
    //              AKHIR BLOK BARU
    // ===============================================

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
        if ($this->image) {
            if ($this->image === 'images/default-news.jpg') {
                return asset($this->image);
            }
            return asset('storage/' . $this->image);
        }
        return asset('images/default-news.jpg');
    }
}