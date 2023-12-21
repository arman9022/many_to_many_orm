<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    // for blade
    // @foreach($questions as $data)
    //     @foreach($data->courses as $course)
    //         {{ $course->name }}<br>
    //     @endforeach
    // @endforeach    
    public function courses(){
        return $this->belongsToMany(Course::class);
    }

    // for controller
    // $data['questions'] = Question::with('course')->get();
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
