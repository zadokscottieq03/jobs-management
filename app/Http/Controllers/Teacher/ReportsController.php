<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Task;
use App\Admin;
use App\Student;
use App\Teacher;
use App\UserTask;
use App\GlobalTask;
use Redirect;

class ReportsController extends Controller
{

    /*
    |------------------------------------------------------------------
    |   Reports Index
    |------------------------------------------------------------------
    */
    	
    	public function index(){

            $teacher_id = Auth::guard('teacher')->user()->id;

            $u_tasks = UserTask::where('teacher_id', $teacher_id)->get();

            $data = [
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('teacher').'/reports/'
        ];

        return View('teacher.reports.index',$data);

    }



    /*
    |------------------------------------------------------------------
    |   Reports Index - Search
    |------------------------------------------------------------------
    */

    public function indexSearch(Request $request){

    
    $teacher_id = Auth::guard('teacher')->user()->id;
    $u_tasks = UserTask::where('teacher_id', $teacher_id)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'data' => $u_tasks,
            'task' => Task::get(),
            'gtask' => GlobalTask::get(),
            'link' => env('teacher').'/reports/'
        ];


        return View('teacher.reports.search',$data);


    }
    
}


