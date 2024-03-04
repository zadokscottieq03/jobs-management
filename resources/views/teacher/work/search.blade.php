@extends('teacher.layout.main')

@section('title') Search Work Log @endsection



@section('content')

<div class="container">

    <div class="section">

        @section('button')

       <a href="{{ Asset($link) }}" class="btn purple waves-effect waves-light right" style="margin-top:25px">Back</a>

        @endsection


        <div class="row">

        <div class="col s12 m12 l12">


         {!! Form::model($data, ['method' => 'GET','url' => [env('teacher').'/work-log/search'],'files' => true,'autocomplete' => 'off'],['class' => 'col s12']) !!}
                        <div class="input-field col s12 l5">

                                <i class="fa fa-calendar prefix"></i>

                                {!! Form::date('from', null,['id' => 'from','required' => 'required', 'class' => 'datepicker' ]) !!}

                                <label for="from">From </label>


                        </div>


                                <div class="input-field col s12 l5">

                                    <i class="fa fa-calendar prefix"></i>

                                    {!! Form::date('to', null,['id' => 'to','required' => 'required', 'class' => 'datepicker' ]) !!}

                                    <label for="to">To </label>


                                </div>

            

                            <div class="input-field col s2 l2">

                        <button class="btn green waves-effect waves-light" type="submit" name="action">Search <i class="fa fa-search left"></i></button>

                            </div>


        </div>
        </div>


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


                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $work)

                            <tr>

                                <td width="20%">{{ $work->name }}</td>

                                <td width="30%" style="text-align: center;">Date: {{($work->created_at)->format('d-m-Y')}} </br> Time: {{($work->created_at)->format('H:i')}}</td>


                                @if($work->ended_at)

                                <td style="text-align: center;" width="30%"> Date: {{($work->ended_at)->format('d-m-Y')}} </br> Time: {{($work->ended_at)->format('H:i')}} </td>

                                @else
                                <td style="text-align: center;" width="30%"> N/A </td>


                                @endif


                                @if($work->ended_at)

                                <td width="20%" style="color: green; text-align: center;"> Finished  </td>

                                @else

                                <td width="20%" style="color: orange; text-align: center;"> Ongoing </td>


                                @endif

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