<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Task;
use App\Admin;
use App\Student;
use App\Teacher;
use App\UserTask;
use Redirect;
use Response;

class TaskController extends Controller
{
    /*
    |------------------------------------------------------------------
    |   Task List Page - Student
    |------------------------------------------------------------------
    */
    public function studentIndex(){


        $admin_id = Auth::guard('admin')->user()->id;

        
        $data = [
            'data' => Task::where('admin_id', $admin_id)->where('asg_teacher_id', null)->where('is_deleted','0')->get(),
            //'task_comment' => new TaskComment,
            'student' => Student::get(),
            'link' => env('admin').'/student-task/'
        ];

        return View('admin.task.student.index',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task List Page - Teacher
    |------------------------------------------------------------------
    */
    public function TeacherIndex(){


        $admin_id = Auth::guard('admin')->user()->id;

        
        $data = [
            'data' => Task::where('admin_id', $admin_id)->where('asg_student_id', null)->where('is_deleted','0')->get(),
            //'task_comment' => new TaskComment,
            'teacher' => Teacher::get(),
            'link' => env('admin').'/teacher-task/'
        ];

        return View('admin.task.teacher.index',$data);
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
            'link' => env('admin').'/student-task/'
        ];

        return View('admin.task.student.add',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Task Add Page - Teacher
    |------------------------------------------------------------------
    */
    public function createTeacherTask()
    {

     $data = [
            'data' => new Task,
            'teacher' => Teacher::get(),
            'link' => env('admin').'/teacher-task/'
        ];

        return View('admin.task.teacher.add',$data);

    }


    /*
    |------------------------------------------------------------------
    |   Task Data Store - Student
    |------------------------------------------------------------------
    */
    public function storeStudentTask(Request $request)
    {

        $admin_id = Auth::guard('admin')->user()->id;

        $data =  new Task;

         if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/student-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }

        $data->admin_id = $admin_id;

        $data->priority = $request->input('priority');


        $data->asg_student_id = $request->input('asg_student_id');

        $data->task_name = $request->input('task_name');

        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');


        $data->save();
       return Redirect(env('admin').'/student-task')->with('message','New Task Created Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   Task Data Store - Teacher
    |------------------------------------------------------------------
    */
    public function storeTeacherTask(Request $request)
    {
        
        $admin_id = Auth::guard('admin')->user()->id;

        $data =  new Task;

        if($data->validate($request->all(),"add")){
            return Redirect(env('admin').'/teacher-task/add')->withErrors($data->validate($request->all(),"add"))->withInput();
        }

        $data->admin_id = $admin_id;

         $data->priority = $request->input('priority');


        $data->asg_teacher_id = $request->input('asg_teacher_id');


        $data->task_name = $request->input('task_name');


        $data->task_desc = $request->input('task_desc');
      
        $data->start_date = $request->input('start_date');
       
        $data->end_date = $request->input('end_date');



        $data->save();

       return Redirect(env('admin').'/teacher-task')->with('message','New Task Created Successfully.');

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
    |   Task Trash List Page - Teacher
    |------------------------------------------------------------------
    */
    public function trashTeacher(){
        $data = [
            'data' => Task::where('is_deleted','1')->where('asg_student_id', null)->get(),
            'teacher' => Teacher::get(),
           
            'link' => env('admin').'/teacher-task/'
        ];

        return View('admin.task.teacher.trash',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Task Trash List Page - Student
    |------------------------------------------------------------------
    */
    public function trashStudent(){
        $data = [
            'data' => Task::where('is_deleted','1')->where('asg_teacher_id', null)->get(),
            'student' => Student::get(),
            'admin' => Admin::get(),
            'teacher' => Teacher::get(),
            'link' => env('admin').'/student-task/'
        ];

        return View('admin.task.student.trash',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Task Data Restore
    |------------------------------------------------------------------
    */
    public function restore($id){
        $data = Task::findOrFail($id);
        $data->is_deleted = false;
        $data->save();

        return back()->with('success_message','Task Restored Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   Task Data Delete (Permanent)
    |------------------------------------------------------------------
    */
    public function destroyPermanent($id){
        $data = Task::findOrFail($id);
        $data->delete();

        return back()->with('message','Task Deleted Successfully.');

    }

    /*
    |------------------------------------------------------------------
    |   Edit Task Page - Teacher
    |------------------------------------------------------------------
    */
    public function teacherEdit($id)
    {


        $data = [
            'id' => $id,
            'data' => Task::findOrFail($id),
            'teacher' => Teacher::where('is_deleted', 0)->get(),
            //'student' => Student::where('is_deleted', 0)->get(),
            'link' => env('admin').'/teacher-task/'
        ];

        return View('admin.task.teacher.edit',$data);
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
            'link' => env('admin').'/student-task/'
        ];

        return View('admin.task.student.edit',$data);
    }

    /*
    |------------------------------------------------------------------
    |   Update Task - Teacher
    |------------------------------------------------------------------
    */
    public function teacherUpdate(Request $request, $id)
    {


        $admin_id = Auth::guard('admin')->user()->id;

        $data =  Task::findOrFail($id);

        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/teacher-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->admin_id = $admin_id;

        $data->asg_teacher_id = $request->input('asg_teacher_id');

        $data->task_name = $request->input('task_name');

        $data->priority = $request->input('priority');


        $data->task_desc = $request->input('task_desc');
      

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->teacher_id = $request->input('asg_teacher_id');

        //$notification->message = 'Your Task has been updated recently';

        //$notification->save();



       return Redirect(env('admin').'/teacher-task')->with('message','Task Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Update Task - Student
    |------------------------------------------------------------------
    */
    public function studentUpdate(Request $request, $id)
    {


        $admin_id = Auth::guard('admin')->user()->id;

        $data =  Task::findOrFail($id);

        if($data->validate($request->all(),"edit")){
            return Redirect(env('admin').'/student-task/'.$id.'/edit')->withErrors($data->validate($request->all(),"edit"))->withInput();
        }

        $data->admin_id = $admin_id;

        $data->asg_student_id = $request->input('asg_student_id');

        $data->task_name = $request->input('task_name');

        $data->priority = $request->input('priority');


        $data->task_desc = $request->input('task_desc');
      
       

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->student_id = $request->input('asg_student_id');

        //$notification->message = 'Your Task has been updated recently';

        //$notification->save();



       return Redirect(env('admin').'/student-task')->with('message','Task Updated Successfully.');


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
            'link' => env('admin').'/student-task/'
        ];

        return View('admin.task.student.extend',$data);
    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Page - Teacher
    |------------------------------------------------------------------
    */
    public function ExtendTeacher($id)
    {


        $task = Task::findOrFail($id);
        $teacher_id = $task->asg_teacher_id;


        $data = [
            'id' => $id,
            'data' => $task,
            'teacher' => Teacher::where('id', $teacher_id)->get(),
            //'student' => Student::where('id', $student_id)->get(),
            'link' => env('admin').'/student-task/'
        ];

        return View('admin.task.teacher.extend',$data);
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
            return Redirect(env('admin').'/student-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }
       
        $data->end_date = $request->input('end_date');

        $data->save();


        //$data->complete_rq = $request->input('complete_rq');


        //$notification = new Notification;

        //$notification->student_id = $request->input('asg_student_id');

        //$notification->message = 'Your Task has been extended recently';

        //$notification->save();



       return Redirect(env('admin').'/student-task')->with('message','End Date Updated Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Extend Time Submit - Teacher
    |------------------------------------------------------------------
    */
    public function ExtendTeacherSubmit(Request $request, $id)
    {



        $data =  Task::findOrFail($id);


        if($data->validate($request->all(),"extend")){
            return Redirect(env('admin').'/teacher-task/'.$id.'/extend')->withErrors($data->validate($request->all(),"extend"))->withInput();
        }

       
        $data->end_date = $request->input('end_date');

        $data->save();


       return Redirect(env('admin').'/teacher-task')->with('message','End Date Updated Successfully.');


    }



    /*
    |------------------------------------------------------------------
    |   Approve Task List
    |------------------------------------------------------------------
    */

    public function ApproveTaskIndex()
    {

        $admin_id = Auth::guard('admin')->user()->id;


        $u_task =  UserTask::where('type','Task')->get();
        $task =  Task::get();
        
        $data = [
            'data' => $u_task,
            'task' => $task,
            'student' => Student::get(),
            'teacher' => Teacher::get(),
            'link' => env('admin').'/task-requests/'
        ];

        return View('admin.task.a_index',$data);

    }

    /*
    |------------------------------------------------------------------
    |   Index - Search
    |------------------------------------------------------------------
    */

    public function ApproveSearch(Request $request){

    
    $admin_id = Auth::guard('admin')->user()->id;
    $u_task = UserTask::where('type','Task')->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
    $task =  Task::get();

        $data = [
           'data' => $u_task,
            'task' => $task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'link' => env('admin').'/task-requests/'
        ];

        return View('admin.task.search',$data);

    }



    /*
    |------------------------------------------------------------------
    |   Approve Tasks
    |------------------------------------------------------------------
    */

    public function ApproveTasks(Request $request, $id)
    {


        $data =  UserTask::findOrFail($id);

        $data->status = 'Approved';
        $data->grade = $request->input('grade');


        $data->save();


       return Redirect(env('admin').'/task-requests')->with('message','Task Approved Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Approve Tasks Page
    |------------------------------------------------------------------
    */

    public function ApproveTasksPage($id)
    {



        $u_task = UserTask::findOrFail($id);
        $task =  Task::get();

        $data = [
            'data' => $u_task,
            'teacher' => Teacher::get(),
            'student' => Student::get(),
            'task' => $task,
            'link' => env('admin').'/task-requests/'
        ];

        return View('admin.task.approve',$data);


    }



    /*
    |------------------------------------------------------------------
    |   Deny Approve Request
    |------------------------------------------------------------------
    */

    public function DenyTask(Request $request, $id)
    {



        $data =  UserTask::findOrFail($id);

       
        $data->status = 'Denied';

        $data->save();


       return Redirect(env('admin').'/task-requests')->with('message','Task Denied Successfully.');


    }


    /*
    |------------------------------------------------------------------
    |   Download Proof
    |------------------------------------------------------------------
    */
    public function downloadProof($id)
    {

            $u_task = UserTask::findOrFail($id);

            $file_path = 'upload/task_proof/'. $u_task->proof;

            if($u_task->proof == null) {

                return back()->with('error','No File Found.');


            }
            return Response::download($file_path);

    }



    /*
    |------------------------------------------------------------------
    |   Extend Requests - Page
    |------------------------------------------------------------------
    */
    public function ExtendRequests(){

        
        $data = [
            'data' => Task::get(),
            'teacher' => Teacher::get(),
            //'student'=> Student::get(),
            'link' => env('admin').'/extend-requests/'
        ];

        return View('admin.task.er_index',$data);
    }



    /*
    |------------------------------------------------------------------
    |   Approve Extend Request
    |------------------------------------------------------------------
    */
    public function Extend($id){

        
        $data = Task::findOrFail($id);
        $data->end_date = $data->extend_rq;
        $data->extend_rq = null;

        $data->save();

       return Redirect(env('admin').'/extend-requests')->with('message','Request Approved Successfully.');

    }


    /*
    |------------------------------------------------------------------
    |   Remove Extend Request
    |------------------------------------------------------------------
    */
    public function erRemove($id){

        
        $data = Task::findOrFail($id);
        $data->extend_rq = null;

        $data->save();

       return Redirect(env('admin').'/extend-requests')->with('message','Request Removed Successfully.');

    }

}
