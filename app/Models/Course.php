<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class , "enrollments");
    }
}
