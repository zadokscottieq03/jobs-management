@extends('admin.layout.main')


@section('title') Approve Task @endsection


@section('content')

<div class="container">

    <div class="section">

        @section('button')

       <a href="{{ Asset($link) }}" class="btn purple waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection

        <div class="row">


            <div class="col s12 m12 l12">

            {!! Form::model($data, ['method' => 'POST','url' => [env('admin').'/task-requests/'.$data->id.'/approve-task'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}



                <div class="col s12 m12 l12">

                    <div class="card-panel">


                        <div class="row">


                            @if($data->student_id != null )

                            <div class="input-field col s12 l12">

                                <i class="fa fa-user prefix"></i>

                                {!! Form::text('student_name', $student->find($data->student_id)->name,['required' => 'required',  'disabled'=> 'disabled']) !!}

                                <label for="student_name"> Student Name *</label>

                            </div>

                            @else


                            <div class="input-field col s12 l12">

                                <i class="fa fa-user prefix"></i>

                                {!! Form::text('teacher_name', $teacher->find($data->teacher_id)->name,['required' => 'required',  'disabled'=> 'disabled']) !!}

                                <label for="teacher_name"> Teacher Name *</label>

                            </div>

                            @endif

                        </div>

                        <br>

                        <div class="row">

                            <div class="input-field col s12 l6">

                                <i class="fa fa-file-text-o prefix"></i>

                                {!! Form::text('task_name', $task->find($data->task_id)->task_name,['required' => 'required',  'disabled'=> 'disabled']) !!}

                                <label for="task_name"> Task Name *</label>

                            </div>




                            <div class="input-field col s12 l6">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::text('complete_date', ($data->created_at)->format('d-m-y'),['required' => 'required', 'disabled'=> 'disabled' ]) !!}

                                <label for="complete_date">Completed At *</label>


                            </div>



                            @if($data->remark)

                            <div class="input-field col s12">

                                <i class="fa fa-exclamation prefix" style="color: red;"></i>

                                 {!! Form::text('remark',null,['id' => 'remark','required' => 'required', 'disabled'=> 'disabled']) !!}

                                     <label for="remark" style="color: red"> Late Completion Reason </label>

                            </div>

                            @endif

                            
                        </div>


                        <div class="row">


                            <div class="input-field col s12 l12">

                                {!! Form::select('grade',['Normal' => 'Normal', 'Average' => 'Average', 'Excellent' => 'Excellent' ], $data->grade) !!}

                            </div>

                        </div>





                        <div class="row">

                            <div class="input-field col s12">

                                <div class="input-field col s12">

                                    <button class="btn purple waves-effect waves-light right" type="submit" name="action">Submit <i class="mdi-content-send right"></i></button>

                                </div>

                            </div>

                        </div>


                    </div>

            </div>


        </div>


    </div>

</div>

@endsection