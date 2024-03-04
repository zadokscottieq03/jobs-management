@extends('admin.layout.main')
@section('title') Manage Teacher @endsection

@section('content')
<div class="container">
    <div class="section">
        @section('button')
        <a href="{{ Asset($link.'add') }}" class="btn purple waves-effect waves-light right" style="margin-top:25px">Add New</a>
        <a href="{{ Asset($link.'trash') }}" class="btn purple waves-effect waves-light right" style="margin-top:25px;margin-right:5px;">View Trash</a>
        @endsection

        <div id="striped-table">
            <div class="row">
                <div class="col s12 m12 l12">
                    <table class="striped" >
                        <thead>
                            <tr>
                                <th>Teacher Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $teacher)
                            <tr>
                                <td width="25%">{{ $teacher->name }}</td>
                                <td width="25%">{{ $teacher->email }}</td>
                                <td width="20%">{!! IMS::status($teacher->status) !!}</td>
                                <td width="30%">
                                    <form action="{{ Asset(env('teacher').'/loginWithID/'.$teacher->id) }}" method="POST" target="_blank" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn purple tooltipped " data-position="top" data-delay="50" data-tooltip="Login as {{ $teacher->name }}" style="padding:0px 10px"><i class="fa fa-sign-in"></i></button>
                                    </form>
                                    <a href="{{ Asset($link.$teacher->id.'/edit') }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Edit This Entry" style="padding:0px 10px"><i class="mdi-editor-mode-edit"></i></a>
                                    <form action="{{ Asset($link.$teacher->id) }}" method="POST" id="delete_form_{{ $teacher->id }}" class="form-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="Delete This Entry" style="padding:0px 10px" onclick="confirmAlert('destroy',this)"><i class="mdi-content-clear"></i></button>
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