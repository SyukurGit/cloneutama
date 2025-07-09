<?php

// app/Models/Leadership.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leadership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image_path',
        'social_link',
        'order',
    ];
}