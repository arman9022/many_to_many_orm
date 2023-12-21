<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index(){
        $data['questions'] = Question::with('course')->get();
        $data['courses'] = Course::all();  
        return view('questions.index',$data);
    }
    public function store(Request $request){
        $data = new Question;
        $data->title = $request->title;
        $data->save();
        $data->courses()->attach($request->input('course_id'));
        return back();
        // $question = Question::create([ 'title' => $request->input('title'), ]);
        // emon kore korle model e fillable dite hobe
    }
    public function update(Request $request, $id){
        $data = Question::findOrFail($id);
        $data->title = $request->title;
        $data->update();
        $data->courses()->sync($request->input('course_id'));
        return back();
        // $data->update([ 'title' => $request->input('title'), ]);
    }
    public function destroy($id){
        $data = Question::findOrFail($id);
        $data->courses()->detach();
        $data->delete();
        return back();
    }
}
