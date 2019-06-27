@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header">Calibration</div>
                <div class="card-body">
                    @if( isset($errors) && count($errors) > 0 )
                    <div class="alert alert-danger">
                        @foreach( $errors->all() as $error )
                        <p>{{$error}}</p>
                        @endforeach
                    </div>
                    @endif
                    {!! Form::open(['route' => 'calibration.store', 'class' => 'form']) !!}
                    {!! Form::hidden('id', $register->id) !!}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>ID:</b></label>
                        <div class="col-md-10">
                            <label class="form-control title-pg">{{$register->department->description}} {{str_pad($register->number,4,'0', STR_PAD_LEFT)}}</label>                                
                        </div>                            
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Laboratoty:</b></label>
                        <div class="col-md-10">
                            {!! Form::select('laboratory_id', $laboratory, null, ['class' => 'form-control title-pg']) !!}                                
                        </div>                            
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Certificate:</b></label>
                        <div class="col-md-10">
                            {!! Form::text('certificate_calibration', null, ['class' => 'form-control'])!!}                              
                        </div>                            
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Next Cal.:</b></label>
                        <div class="col-md-10">
                            <label class="form-control">{{ date('M j, Y', strtotime( '+' . $register->period->period_at_month . ' months', strtotime(date("Y-m-d")))) }}</label>                                
                        </div>                            
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            {!! Form::submit('save', ['class' => 'btn btn-primary'])!!}                                
                        </div>                            
                    </div>                    
                    {!! Form::close() !!}
                </div>
            </div>            
        </div>        
    </div>
</div>
@endsection