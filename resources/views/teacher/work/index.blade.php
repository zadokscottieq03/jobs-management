@extends('teacher.layout.main')

@section('title') Work Log @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

       <a href="{{ Asset($link.'add') }}" class="btn purple waves-effect waves-light right" style="margin-top:25px">Add New</a>

        <a href="{{ Asset($link.'search') }}" class="btn purple waves-effect waves-light right" style="margin-top:25px;margin-right:5px;">Search</a>


        @endsection



        <div id="striped-table">

            <div class="row">

                <div class="col s12 m12 l12">

                    <table class="striped" >

                        <thead>

                            <tr>

                                <th>Work Name</th>

                                <th style="text-align: center;">Started At </th>

                                <th style="text-align: center;">Ended At </th>

                                <th style="text-align: center;">Status </th>

                                <th style="text-align: center;">Options </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $work)

                            <tr>

                                <td width="15%">{{ $work->name }}</td>

                                <td width="25%" style="text-align: center;">Date: {{($work->created_at)->format('d-m-Y')}} </br> Time: {{($work->created_at)->format('H:i')}}</td>


                                @if($work->ended_at)

                                <td style="text-align: center;" width="25%"> Date: {{($work->ended_at)->format('d-m-Y')}} </br> Time: {{($work->ended_at)->format('H:i')}} </td>

                                @else
                                <td style="text-align: center;" width="25%"> N/A </td>


                                @endif


                                @if($work->ended_at)

                                <td width="15%" style="color: green; text-align: center;"> Finished  </td>

                                @else

                                <td width="15%" style="color: orange; text-align: center;"> Ongoing </td>


                                @endif


                                <td width="20%" style="text-align: center;">

                                    

                                    <a href="{{ Asset($link.$work->id.'/edit') }}" class="btn green tooltipped " data-position="top" data-delay="50" data-tooltip="Edit This Work" style="padding:0px 10px"><i class="mdi-editor-mode-edit"></i></a>


                                @if(! $work->ended_at)


                                    <form action="{{ Asset($link.$work->id.'/end') }}" method="POST" id="End_form_{{ $work->id }}" class="form-inline">

                                        @csrf

                                        @method('PATCH')

                                        <button type="button" class="btn red tooltipped " data-position="top" data-delay="50" data-tooltip="End This Work" style="padding:0px 10px" onclick="confirmAlert('end',this)"><i class="fa fa-power-off"></i></button>

                                    </form>
                                @endif

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