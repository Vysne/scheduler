<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'author',
        'image',
        'type',
        'requirements',
        'course-descr-body',
        'limit',
        'virtual',
        'enlistments',
        'rating',
        'visible',
        'rating'
    ];

    public function courseInformation()
    {
        return $this->hasMany(CourseInformation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enlistments()
    {
        return $this->hasMany(Enlistments::class);
    }
}
