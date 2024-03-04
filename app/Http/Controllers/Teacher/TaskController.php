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
use Carbon\Carbon;
use Redirect;

class TaskController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Task List Page - Student
    |------------------------------------------------------------------
    */
    public function studentIndex(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => Task::where('teacher_id', $teacher_id)->where('asg_teacher_id', null)->where('is_deleted','0')->get(),
            //'task_comment' => new TaskComment,
            'student' => Student::where('is_deleted','0')->get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task List Page - Self
    |------------------------------------------------------------------
    */
    public function TeacherIndex(){


        $teacher_id = Auth::guard('teacher')->user()->id;

        
        $data = [
            'data' => Task::where('asg_teacher_id', $teacher_id)->where('is_deleted','0')->get(),
            //'task_comment' => new TaskComment,
            'teacher' => Auth::guard('teacher'),
            'admin' => Admin::get(),
            'link' => env('teacher').'/self-task/'
        ];

        return View('teacher.task.self.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task Add Page - Student
    |------------------------------------------------------------------
    */
    public function createStudentTask()
    {

     $data = [
            'data' => new Task,
            'student' => Student::get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.add',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Task Data Store - Student
    |------------------------------------------------------------------
    */
    public function storeStudentTask(Request $request)
    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  new Task;

         if($data->validate($request->all(),"add")){
            return Redirect(env('teacher').'/student-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }

        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');


        $data->asg_student_id = $request->input('asg_student_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');

        //$data->complete_rq = $request->input('complete_rq');


        $data->save();
       return Redirect(env('teacher').'/student-task')->with('message','New Task Created Successfully.');

    }



    /*
    |------------------------------------------------------------------
    |   Task Delete (Trash Data)
    |------------------------------------------------------------------
    */

    public function destroy($id)
    {
        //
        $data = Task::findOrFail($id);
        $data->is_deleted = 1;
        $data->save();

        return back()->with('message','Task Deleted Successfully.');
    }



    /*
    |------------------------------------------------------------------
    |   Edit Task Page - Student
    |------------------------------------------------------------------
    */

    public function StudentEdit($id)
    {


        $data = [
            'id' => $id,
            'data' => Task::findOrFail($id),
            //'teacher' => Teacher::where('is_deleted', 0)->get(),
            'student' => Student::where('is_deleted', 0)->get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.edit',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Update Task - Student
    |------------------------------------------------------------------
    */

    public function studentUpdate(Request $request, $id)

    {

        $teacher_id = Auth::guard('teacher')->user()->id;

        $data =  Task::findOrFail($id);


         if($data->validate($request->all(),"edit")){
            return Redirect(env('teacher').'/student-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }


        $data->teacher_id = $teacher_id;

        $data->priority = $request->input('priority');


        $data->asg_student_id = $request->input('asg_student_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');

        //$notification = new Notification;

        //$notification->student_id = $request->input('asg_student_id');

        //$notification->message = 'Your Task has been updated recently';

        //$notification->save();



       return Redirect(env('teacher').'/student-task')->with('message','Task Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Page - Student
    |------------------------------------------------------------------
    */
    public function ExtendStudent($id)
    {


        $task = Task::findOrFail($id);
        $student_id = $task->asg_student_id;


        $data = [
            'id' => $id,
            'data' => $task,
            //'teacher' => Teacher::where('is_deleted', 0)->get(),
            'student' => Student::where('id', $student_id)->get(),
            'link' => env('teacher').'/student-task/'
        ];

        return View('teacher.task.student.extend',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Extend Time Submit - Student
    |------------------------------------------------------------------
    */
    public function ExtendStudentSubmit(Request $request, $id)
    {

        $data =  Task::findOrFail($id);


        if($data->validate($request->all(),"extend")){
            return Redirect(env('teacher').'/student-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }
       
        $data->extend_rq = $request->input('end_date');

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');

        //$notification = new Notification;

        //$notification->student_id = $request->input('asg_student_id');

        //$notification->message = 'Your Task has been extended recently';

        //$notification->save();



       return Redirect(env('teacher').'/student-task')->with('message','Request Submitted Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit - Page
    |------------------------------------------------------------------
    */
    public function SendProofPage($id)
    {


        $task = Task::findOrFail($id);
        $teacher_id = Auth::guard('teacher')->user()->id;


    if (UserTask::where('task_id', $id )->where('teacher_id', $teacher_id)->count() > 0) {


        $data = [
        
            'link' => env('teacher').'/self-task/',

            ];
                return View('teacher.task.self.submitted', $data);
        }

        $data = [
            'id' => $id,
            'data' => $task,
            'today' => Carbon::today(),
            'link' => env('teacher').'/self-task/'
        ];

        return View('teacher.task.self.proof_submit',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Proof Submit
    |------------------------------------------------------------------
    */


    public function SendProof(Request $request, $id)


    {
        $task =  Task::findOrFail($id);

        $teacher_id = Auth::guard('teacher')->user()->id;


        $data = new UserTask;
       
        $data->teacher_id = $teacher_id;

        $data->task_id = $task->id;

        $data->remark = $request->input('remark');

        $data->type = 'Task';


        $proof = time().'.'.request()->proof->getClientOriginalExtension();

        
        $data->proof = $proof;

            
        request()->proof->move("upload/task_proof/", $proof);



        $data->save();


        return Redirect(env('teacher').'/self-task')->with('message','Proof Submitted Successfully.');

    }


}
