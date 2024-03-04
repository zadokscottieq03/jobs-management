@extends('admin.layout.main')
@section('title') Add New Teacher @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link) }}" class="btn purple waves-effect waves-light right" style="margin-top:25px">Back</a>
        @endsection
        
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row">
                        {!! Form::model($data, ['url' => [env('admin').'/teacher'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                        <h4 class="header2">Create New Teacher Here</h4>
                        @include('admin.users.teacher.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection