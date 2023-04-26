<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'key',
        'text',
        'day',
        'time',
        'skill',
        'image',
        'visible'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
