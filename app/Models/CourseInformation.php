<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'course_id',
        'key',
        'syllabus-name',
        'element-name',
        'syllabus-descr-body',
        'instructor-descr-body',
        'day',
        'time',
        'skill',
        'location',
        'img',
        'visible',
        'created_at',
        'updated_at'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
