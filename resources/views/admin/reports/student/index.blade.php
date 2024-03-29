@extends('admin.layout.main')
@section('title') Check Student Reports @endsection

@section('content')
<div class="container">
    <div class="section">

        <div id="striped-table">
            <div class="row">
                <div class="col s12 m12 l12">
                    <table class="striped" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="text-align: center;">Student Name</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Check Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $student)
                            <tr>
                                <td width="10%"> {{ $student->id }} </td>
                                <td width="20%" style="text-align: center;">{{ $student->name }}</td>
                                <td width="25%" style="text-align: center;">{{ $student->email }}</td>
                                <td width="20%" style="text-align: center;">{!! IMS::status($student->status) !!}</td>
                                <td width="25%" style="text-align: center;">
                                    <a href="{{ Asset($link.$student->id) }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Check Report For This Student" style="padding:0px 10px"><i class="fa fa-bar-chart"></i></a>
                            
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