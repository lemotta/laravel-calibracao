@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header">Show xxx</div>
                <div class="card-body">                    
                    <p><b>Manufacturer : </b>{{$modelofequipament->manufacturer->name}}</p>
                    <p><b>Class : </b>{{$modelofequipament->typeofequipament->type}}</p>
                    <p><b>Model : </b>{{$modelofequipament->model}}</p>
                    {!! Form::open(['route' => ['models_eqp.destroy', $modelofequipament->id], 'method' => 'delete']) !!}
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