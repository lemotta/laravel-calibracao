@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($modelofequipament))                
                <div class="card-header">edit xxx</div>
                @else
                <div class="card-header">add xxx</div>
                @endif
                <div class="card-body">
                    @if( isset($errors) && count($errors) > 0 )
                    <div class="alert alert-danger">
                        @foreach( $errors->all() as $error )
                        <p>{{$error}}</p>
                        @endforeach
                    </div>
                    @endif
                    @if(isset($modelofequipament))
                    {!! Form::model($modelofequipament, ['route' => ['models_eqp.update', $modelofequipament->id], 'class' => 'form', 'method' => 'put'])!!}
                    @else
                    {!! Form::open(['route' => 'models_eqp.store', 'class' => 'form']) !!}
                    @endif
                    <div class="form-group">                        
                        {!! Form::select('manufacturer_id', $manufacturer, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">                        
                        {!! Form::select('typeofequipament_id', $typeofequipament, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('model', null, ['class' => 'form-control', 'placeholder' => 'serial:'])!!}
                    </div>
                    {!! Form::submit('save', ['class' => 'btn btn-primary'])!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection