@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header">Show Register</div>
                <div class="card-body">                    
                    <p class="title-pg"><b>ID : </b>{{$register->department->description}} {{str_pad($register->number,4,'0', STR_PAD_LEFT)}}</p>
                    <p><b>Serial Number : </b>{{$register->serialnumber}}</p>
                    <p><b>Type of Equipament : </b>{{$register->modelofequipament->typeofequipament->type}}</p>
                    <p><b>Model of Equipament : </b>{{$register->modelofequipament->model}}</p>
                    <p><b>Manufacturer : </b>{{$register->modelofequipament->manufacturer->name}}</p>
                    @if($register->require_calibration == 0)
                    <p><b>Require Calibration : </b>no</p>
                    @else
                    <p><b>Require Calibration : </b>yes</p>
                    @endif
                    @if($register->is_pattern == 0)
                    <p><b>Pattern : </b>no</p>
                    @else
                    <p><b>Pattern : </b>yes</p>
                    @endif
                    @if($register->active == 0)
                    <p><b>Active : </b>no</p>
                    @else
                    <p><b>Active : </b>yes</p>
                    @endif
                    @if(isset($register->period_id))
                    <p><b>Period : </b>{{$register->period->period_at_month}} months</p>
                    @else
                    <p><b>Period : </b>no calibration required</p>
                    @endif
                    @if(isset($register->report_id))
                    <p><b>Report : </b>{{$register->report->number}}</p>
                    @else
                    <p><b>Report : </b>no report</p>
                    @endif                    
                    <p><b>Instruction : </b>{{$register->instruction->id}} - {{$register->instruction->description}}</p>
                    <p><b>Contact : </b>{{$register->contact}}</p>
                    <p><b>Created at : </b>{{date('M j, Y', strtotime($register->created_at))}}</p>
                    <p><b>Update at : </b>{{date('M j, Y', strtotime($register->updated_at))}}</p>
                    {!! Form::open(['route' => ['registers.destroy', $register->id], 'method' => 'delete']) !!}
                    @if(isset($register->report_id))
                    <a href="{{route($register->report->route, $register->id)}}" class="btn btn-primary">calibration</a>
                    @else
                    @if($register->require_calibration == 1)
                    <a href="" class="btn btn-primary">calibration</a>
                    @endif
                    @endif
                    {!! Form::submit("delete", ['class' => 'btn btn-danger']) !!}                                        
                    {!! Form::close() !!}
                </div>
            </div>
            @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error )
                <p>{{$error}}</p>
                @endforeach
            </div>
            @endif
        </div>        
    </div>
</div>
@endsection