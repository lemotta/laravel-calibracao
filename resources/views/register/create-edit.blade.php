@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($register))                
                <div class="card-header">Edit Register</div>
                @else
                <div class="card-header">Add Register</div>
                @endif
                <div class="card-body">
                    @if( isset($errors) && count($errors) > 0 )
                    <div class="alert alert-danger">
                        @foreach( $errors->all() as $error )
                        <p>{{$error}}</p>
                        @endforeach
                    </div>
                    @endif
                    @if(isset($register))
                    {!! Form::model($register, ['route' => ['registers.update', $register->id], 'class' => 'form', 'method' => 'put'])!!}
                    @else
                    {!! Form::open(['route' => 'registers.store', 'class' => 'form']) !!}
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Department:</b></label>
                        <div class="col-md-10">
                            {!! Form::select('department_id', $department, null, ['class' => 'form-control title-pg']) !!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Number:</b></label>
                        <div class="col-md-10">
                            {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'numero:'])!!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Serial:</b></label>
                        <div class="col-md-10">
                            {!! Form::text('serialnumber', null, ['class' => 'form-control', 'placeholder' => 'serial:'])!!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Model of Eq.:</b></label>
                        <div class="col-md-10">
                            {!! Form::select('modelofequipament_id', $modeloofequipament, null, ['class' => 'form-control'])!!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"><b>Pattern:</b></div>
                        <div class="col-md-10">
                            <div class="form-check">
                                @if(isset($register))
                                @if($register->is_pattern==0)
                                {!! Form::checkbox('is_pattern', '1', false, [ 'class' => 'form-check-input']) !!}
                                @else
                                {!! Form::checkbox('is_pattern', '1', true, [ 'class' => 'form-check-input']) !!}
                                @endif
                                @else
                                {!! Form::checkbox('is_pattern', '1', false, [ 'class' => 'form-check-input']) !!}
                                @endif                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"><b>Active:</b></div>
                        <div class="col-md-10">
                            <div class="form-check">
                                @if(isset($register))
                                @if($register->active==0)
                                {!! Form::checkbox('active', '1', false, [ 'class' => 'form-check-input']) !!}                                
                                @else
                                {!! Form::checkbox('active', '1', true, [ 'class' => 'form-check-input']) !!}                                
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Period:</b></label>
                        <div class="col-md-10">
                            {!! Form::select('period_id', $period, null, ['class' => 'form-control']) !!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Report:</b></label>
                        <div class="col-md-10">
                            {!! Form::select('report_id', $report, null, ['class' => 'form-control']) !!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Instruction:</b></label>
                        <div class="col-md-10">
                            {!! Form::select('instruction_id', $instruction, null, ['class' => 'form-control']) !!}
                        </div>                       
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Email:</b></label>
                        <div class="col-md-10">
                            {!! Form::email('contact', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
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