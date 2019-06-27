@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">                
                <div class="card-header">
                    Models of Equipament
                    <a href="{{route('models_eqp.create')}}" class="btn btn-primary btn-add float-right"><span class="glyphicon glyphicon-plus"></span>Register</a>
                </div>
                <div class="card-body">                    
                    <table class="table table-striped">
                        <tr>        
                            <th>Manufacturer</th>        
                            <th>Type</th>
                            <th>Model</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($modelofequipaments as $modelofequipament)
                        <tr>        
                            <td>{{$modelofequipament->manufacturer->name}}</td>
                            <td>{{$modelofequipament->typeofequipament->type}}</td>
                            <td>{{$modelofequipament->model}}</td>        
                            <td>{{date('M j, Y', strtotime($modelofequipament->created_at))}}</td>
                            <td>
                                <a href="{{route('models_eqp.edit',$modelofequipament->id)}}" class="actions edit">
                                    <button type="button" class="btn btn-secondary">Edit</button>
                                </a>
                                <a href="{{route('models_eqp.show',$modelofequipament->id)}}" class="actions delete">
                                    <button type="button" class="btn btn-info">View</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection