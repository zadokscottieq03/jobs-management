@extends('admin.layout.main')
@section('title') Student Trash @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link) }}" class="btn purple waves-effect waves-light right" style="margin-top:25px">Back</a>
        @endsection

        <div id="striped-table">
            <div class="row">
                <div class="col s12 m12 l12">
                    <table class="striped" >
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $student)
                            <tr>
                                <td width="30%">{{ $student->name }}</td>
                                <td width="40%">{{ $student->email }}</td>
                                <td width="30%">
                                    <form action="{{ Asset($link.'restore/'.$student->id) }}" method="POST" id="restore_form_{{ $student->id }}" class="form-inline">
                                        @csrf
                                        <button type="button" class="btn purple tooltipped " data-position="top" data-delay="50" data-tooltip="Restore This Entry" style="padding:0px 10px" onclick="confirmAlert('restore',this)"><i class="fa fa-undo"></i></button>
                                    </form>
                                    <form action="{{ Asset($link.'destroy_permanent/'.$student->id) }}" method="POST" id="delete_form_{{ $student->id }}" class="form-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Delete This Entry" style="padding:0px 10px" onclick="confirmAlert('destroy_permanent',this)"><i class="mdi-content-clear"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection