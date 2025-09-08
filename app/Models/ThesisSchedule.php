<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // ===> TAMBAHKAN BLOK KODE INI <===
    protected $fillable = [
        'title',
        'url',
        'order',
    ];
    // ===> BATAS PENAMBAHAN <===
}