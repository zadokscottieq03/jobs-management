<?php

namespace App\Http\Controllers\Teacher;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;

class WorkController extends Controller
{
   

    /*
    |------------------------------------------------------------------
    | List Work Page
    |------------------------------------------------------------------
    */
    public function index(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => Work::where('teacher_id', $teacher_id)->get(),
            'link' => env('teacher').'/work-log/'
        ];

        return View('teacher.work.index',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Work Add Page
    |------------------------------------------------------------------
    */

    public function create()
    {

     $data = [
            'data' => new Work,
            'link' => env('teacher').'/work-log/'
        ];

        return View('teacher.work.add',$data);

    }

   
    /*
    |------------------------------------------------------------------
    |   Work Data Store
    |------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $teacher_id = Auth::guard('teacher')->user()->id;

         $data =  new Work;

         if($data->validate($request->all(),"add")){
            return Redirect(env('teacher').'/work-log/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->name = $request->input('name');
        $data->desc = $request->input('desc');

        $data->ended_at = null;

        $data->save();

        return Redirect(env('teacher').'/work-log')->with('message','Work Created Successfully.');

    }

  
    /*
    |------------------------------------------------------------------
    |   Edit Work Page
    |------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data = [
            'id' => $id,
            'data' => Work::findOrFail($id),
            'link' => env('teacher').'/work-log/'
        ];

        return View('teacher.work.edit',$data);

    }

    /*
    |------------------------------------------------------------------
    |   Update Work Page
    |------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {

       $teacher_id = Auth::guard('teacher')->user()->id;

         $data =  Work::findOrFail($id);

         if($data->validate($request->all(),"edit")){
            return Redirect(env('teacher').'/work-log/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->name = $request->input('name');
        $data->desc = $request->input('desc');

        $data->ended_at = $data->ended_at;

        $data->save();

        return Redirect(env('teacher').'/work-log')->with('message','Work Updated Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   End Task
    |------------------------------------------------------------------
    */
    public function endWork(Request $request, $id)
    {

       $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  Work::findOrFail($id);

    if ( $teacher_id == $data->teacher_id){

        $data->ended_at = now();

        $data->save();

        return Redirect(env('teacher').'/work-log')->with('message','Work Ended Successfully.');


    }


    return back()->withErros('You do not have access to this!');

       

    }

    /*
    |------------------------------------------------------------------
    |   Reports Index - Search
    |------------------------------------------------------------------
    */

    public function indexSearch(Request $request){

    
    $teacher_id = Auth::guard('teacher')->user()->id;
    $work = Work::where('teacher_id', $teacher_id)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        $data = [
            'data' => $work,
            'link' => env('teacher').'/work-log/'
        ];


        return View('teacher.work.search',$data);


    }

}
