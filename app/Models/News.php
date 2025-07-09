<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'category',
        'status',
        'study_program_id',
    ];

    /**
     * Mendefinisikan relasi ke model StudyProgram.
     * Sebuah berita bisa jadi milik satu program studi.
     */
    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}