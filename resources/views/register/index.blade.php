@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-header">
                    Registers
                    <a href="{{route('registers.create')}}" class="btn btn-primary btn-add float-right"><span class="glyphicon glyphicon-plus"></span>Register</a>
                </div>
                <div class="card-body">                    
                    <table class="table table-striped">
                        <tr>        
                            <th>ID</th>        
                            <th>Serial</th>
                            <th>Type</th>
                            <th>Model</th>
                            <th>Pattern</th>
                            <th>Calibration</th>
                            <th>Active</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($registers as $register)
                        <tr>        
                            <td class="title-pg">{{$register->department->description}} {{str_pad($register->number,4,'0', STR_PAD_LEFT)}}</td>
                            <td>{{$register->serialnumber}}</td>                                    
                            <td>{{$register->modelofequipament->typeofequipament->type}}</td>
                            <td>{{$register->modelofequipament->model}}</td>
                            @if($register->is_pattern == 0)
                            <td>no</td>
                            @else
                            <td>yes</td>
                            @endif
                            @if($register->require_calibration == 0)
                            <td>no</td>
                            @else
                            <td>yes</td>
                            @endif
                            @if($register->active == 0)
                            <td>no</td>
                            @else
                            <td>yes</td>
                            @endif  
                            <td>{{date('M j, Y', strtotime($register->created_at))}}</td>
                            <td>                               
                                <a href="{{route('registers.show',$register->id)}}" class="actions delete">
                                    <button type="button" class="btn btn-info">View</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $registers->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection