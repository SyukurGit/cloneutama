<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = ['name_id', 'name_en', 'slug'];

    // Relasi ke Berita (banyak-ke-banyak)
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_tag');
    }
}