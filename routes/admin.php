<?php

/*
|----------------------------------------------------------------
|	Admin Routes
|----------------------------------------------------------------
*/
Route::group(array('prefix' => env('admin'),'namespace' => 'Admin'), function(){
    Route::get('/','AdminController@root');
    Route::get('login','AdminController@index');
    Route::post('login','AdminController@login');
    Route::get('logout','AdminController@logout');

    Route::group(['middleware' => 'admin'], function(){
        
        /*
        |----------------------------------------------------------------
        |   Dashboard & Account Settings
        |----------------------------------------------------------------
        */
        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::post('settings','AdminController@update');

     
        /*
        |----------------------------------------------------------
        |   Manage Teacher User
        |----------------------------------------------------------
        */
        Route::get('teacher/trash','TeacherController@trash');
        Route::post('teacher/restore/{id}','TeacherController@restore');
        Route::delete('teacher/destroy_permanent/{id}','TeacherController@destroyPermanent');
       // Route::get('teacher/{id}/add_task','TeacherController@addTask');
        //Route::post('teacher/{id}/add_task','TeacherController@addTaskStore');
        //Route::post('teacher/{id}/finish_task','TeacherController@finishTask');
        Route::resource('teacher','TeacherController');

       /*
        |----------------------------------------------------------
        |   Manage Student User
        |----------------------------------------------------------
        */
        Route::get('student/trash','StudentController@trash');
        Route::post('student/restore/{id}','StudentController@restore');
        Route::delete('student/destroy_permanent/{id}','StudentController@destroyPermanent');
        //Route::get('student/{id}/add_task','StudentController@addTask');
        //Route::post('student/{id}/add_task','StudentController@addTaskStore');
        //Route::post('student/{id}/finish_task','StudentController@finishTask');
        Route::resource('student','StudentController');
        

        /*
        |----------------------------------------------------------
        |   Manage Notifications
        |----------------------------------------------------------
        */


        // List Notifications
        Route::get('notifications','NotificationController@index');

        // Delete Notification
        Route::delete('notifications/destroy/{id}','NotificationController@destroy');



        /*
        |----------------------------------------------------------
        |   Manage Tasks
        |----------------------------------------------------------
        */

                        /////// Student Tasks ///////

            // List Student Tasks
            Route::get('student-task','TaskController@studentIndex');

            // Create Student Tasks page
            Route::get('student-task/add','TaskController@createStudentTask');

            // Store Student Tasks Route
            Route::post('student-task/store','TaskController@storeStudentTask');

            // Show all Trashed Student Tasks
            Route::get('student-task/trash','TaskController@trashStudent');
            

            // Edit Student Tasks
           Route::get('student-task/{id}/edit','TaskController@StudentEdit');

            // Update Student Tasks
           Route::post('student-task/{id}/update','TaskController@studentUpdate');

            //Destroy Permanent
            Route::delete('student-task/destroy_permanent/{id}','TaskController@destroyPermanent');

            // Destroy (trash)
            Route::patch('student-task/destroy/{id}','TaskController@destroy');

            // Restore (from Trash)
            Route::patch('student-task/restore/{id}','TaskController@restore');


              // Extend Student Task Page
           Route::get('student-task/{id}/extend','TaskController@ExtendStudent');

            // Extend Student Task Submit
           Route::post('student-task/{id}/extend-submit','TaskController@ExtendStudentSubmit');


                            /////// Teacher Tasks ///////

            // List Teacher Tasks
            Route::get('teacher-task','TaskController@TeacherIndex');

            // Create Teacher Tasks page
            Route::get('teacher-task/add','TaskController@createTeacherTask');

            // Store Teacher Tasks Route
            Route::post('teacher-task/store','TaskController@storeTeacherTask');

            // Show all Trashed Teacher Tasks
            Route::get('teacher-task/trash','TaskController@trashTeacher');
            

            // Edit Teacher Tasks
           Route::get('teacher-task/{id}/edit','TaskController@teacherEdit');

            // Update Teacher Tasks
           Route::post('teacher-task/{id}/update','TaskController@teacherUpdate');

            //Destroy Permanent
            Route::delete('teacher-task/destroy_permanent/{id}','TaskController@destroyPermanent');

            // Destroy (trash)
            Route::patch('teacher-task/destroy/{id}','TaskController@destroy');

            // Restore (from Trash)
            Route::patch('teacher-task/restore/{id}','TaskController@restore');



            // Extend Teacher Task Page
           Route::get('teacher-task/{id}/extend','TaskController@ExtendTeacher');

            // Extend Teacher Task Submit
           Route::post('teacher-task/{id}/extend-submit','TaskController@ExtendTeacherSubmit');


                         /////// Approve Requests ///////


         // List Approve Requests
        Route::get('task-requests','TaskController@ApproveTaskIndex');


        //Search
        Route::get('task-requests/search','TaskController@ApproveSearch');


        // Approve Task Page
        Route::get('task-requests/{id}/approve','TaskController@ApproveTasksPage');

        // Approve Tasks Route
        Route::post('task-requests/{id}/approve-task','TaskController@ApproveTasks');


        //Deny Tasks
        Route::patch('task-requests/{id}/deny','TaskController@DenyTask');


        //Download Proof
        Route::get('task-requests/{id}/download-proof','TaskController@downloadProof');



        /*
        |----------------------------------------------------------
        |   Manage GlobalTasks
        |----------------------------------------------------------
        */

        // List GlobalTasks
        Route::get('g-task','GlobalTaskController@index');

        // Create GlobalTask - page
        Route::get('g-task/add','GlobalTaskController@create');

        // Store GlobalTask - Route
        Route::post('g-task/store','GlobalTaskController@store');

        // Show all Trashed GlobalTasks
        Route::get('g-task/trash','GlobalTaskController@trash');
            

        // Edit GlobalTask
        Route::get('g-task/{id}/edit','GlobalTaskController@edit');

        // Update GlobalTask
        Route::post('g-task/{id}/update','GlobalTaskController@update');

        //Destroy Permanent
        Route::delete('g-task/destroy_permanent/{id}','GlobalTaskController@destroyPermanent');

        // Destroy (trash)
        Route::patch('g-task/destroy/{id}','GlobalTaskController@destroy');

        // Restore (from Trash)
        Route::patch('g-task/restore/{id}','GlobalTaskController@restore');


        // Extend GlobalTask - Page
        Route::get('g-task/{id}/extend','GlobalTaskController@extend');

        // Extend GlobalTask - Submit
        Route::post('g-task/{id}/extend-submit','GlobalTaskController@extendSubmit');


         // List Approve Requests
        Route::get('g-task-requests','GlobalTaskController@ApproveTaskIndex');

        //Search
        Route::get('g-task-requests/search','GlobalTaskController@ApproveSearch');

        // Approve GlobalTask Page
        Route::get('g-task-requests/{id}/approve','GlobalTaskController@ApproveTasksPage');

        // Approve GlobalTask Route
        Route::post('g-task-requests/{id}/approve-g-task','GlobalTaskController@ApproveTasks');


        //Deny GlobalTask - Request
        Route::patch('g-task-requests/{id}/deny','GlobalTaskController@DenyTask');
        

        //Download Proof
        Route::get('g-task-requests/{id}/download-proof','GlobalTaskController@downloadProof');


        /*
        |----------------------------------------------------------
        |   Manage Extend Requests
        |----------------------------------------------------------
        */


         //Extend request Page
        Route::get('extend-requests','TaskController@ExtendRequests');


        //Extend Request - Approve
        Route::patch('extend-requests/{id}/extend','TaskController@Extend');


        //Extend Request - Remove
        Route::patch('extend-requests/{id}/remove','TaskController@erRemove');



        /*
        |----------------------------------------------------------
        |   Manage Global Tasks Extend Requests
        |----------------------------------------------------------
        */
        

         //Extend request Page
        Route::get('g-extend-requests','GlobalTaskController@ExtendRequests');


        //Extend Request - Approve
        Route::patch('g-extend-requests/{id}/extend','GlobalTaskController@ExtendR');


        //Extend Request - Remove
        Route::patch('g-extend-requests/{id}/remove','GlobalTaskController@erRemove');





        /*
        |----------------------------------------------------------
        |   Manage Reports
        |----------------------------------------------------------
        */

        //Student Index
        Route::get('student-reports','ReportsController@student_index');


        // Student Reports Page
        Route::get('student-reports/{id}','ReportsController@student_report');
        Route::get('student-reports/{id}/search','ReportsController@student_Search');



        //Teacher Index
        Route::get('teacher-reports','ReportsController@teacher_index');


        // Teacher Reports Page
        Route::get('teacher-reports/{id}','ReportsController@teacher_report');
        Route::get('teacher-reports/{id}/search','ReportsController@teacher_Search');



        //All Reports
        Route::get('reports-all','ReportsController@report_all');
        Route::get('reports-all/search','ReportsController@Search_all');



    });
});