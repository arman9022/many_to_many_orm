<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $data['courses'] = Course::all();
        return view('courses.index',$data);
    }
    public function store(Request $request){
        $data = new Course;
        $data->name = $request->name;
        $data->save();
        return back();
    }
    public function update(Request $request, $id){
        $data = Course::find($id);
        $data->name = $request->name;
        $data->update();
        return back();
    }
    public function destroy($id){
        $data = Course::find($id);
        $data->questions()->detach();
        $data->delete();
        return back();
    }
}
