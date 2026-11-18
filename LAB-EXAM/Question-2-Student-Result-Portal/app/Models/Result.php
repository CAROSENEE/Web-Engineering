<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['student_id', 'course_code', 'marks', 'grade'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public static function gradeFor(float $marks): string
    {
        return match (true) {
            $marks >= 80 => 'A+', $marks >= 75 => 'A', $marks >= 70 => 'A-',
            $marks >= 65 => 'B+', $marks >= 60 => 'B', $marks >= 55 => 'B-',
            $marks >= 50 => 'C+', $marks >= 45 => 'C', $marks >= 40 => 'D',
            default => 'F',
        };
    }
}
