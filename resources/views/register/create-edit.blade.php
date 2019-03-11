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
                    <div class="form-group">                        
                        {!! Form::select('department_id', $department, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">                        
                        {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'numero:'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('serialnumber', null, ['class' => 'form-control', 'placeholder' => 'serial:'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('modelofequipament_id', $modeloofequipament, null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">

                        @if(isset($register))
                        @if($register->is_spattern==0)
                        {!! Form::checkbox('is_pattern', '1', false) !!}
                        @else
                        {!! Form::checkbox('is_pattern', '1', true) !!}
                        @endif
                        @else
                        {!! Form::checkbox('is_pattern', '1', false) !!}
                        @endif                        
                        {!! Form::label('labelpattern', 'pattern') !!}

                        @if(isset($register))
                        @if($register->active==0)
                        {!! Form::checkbox('active', '1', false) !!}                                
                        @else
                        {!! Form::checkbox('active', '1', true) !!}                                
                        @endif
                        @endif
                        {!! Form::label('labelactive', 'active') !!}

                    </div>
                    <div class="form-group">                        
                        {!! Form::select('period_id', $period, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('report_id', $report, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('instruction_id', $instruction, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('contact', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
                    </div>
                    {!! Form::submit('save', ['class' => 'btn btn-primary'])!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection