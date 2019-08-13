@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">        
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">
                    Calibrations
                    <a href="{{route('calibration.index')}}" class="btn btn-primary btn-add float-right"><span class="glyphicon glyphicon-plus"></span>Calibrations</a>
                </div>                
                <div class="card-body">                    
                    <table class="table table-striped">
                        <tr>        
                            <th>Status</th>
                            <th>ID</th>        
                            <th>Serial</th>
                            <th>Type</th>
                            <th>Model</th>
                            <th>Laboratory</th>
                            <th>Next Calibration</th> 
                            <th>Action</th>
                        </tr>
                        @foreach($calibration as $cal)
                        <tr>        
                            @if(strtotime($cal->next_calibration) < strtotime(date('Y-m-d')))
                            <td><b><font color="red">Expired</font></b></td>
                            @else
                            <td><b>Urgent</b></td>
                            @endif
                            <td class="title-pg">{{$cal->register->department->description}} {{str_pad($cal->register->number,4,'0', STR_PAD_LEFT)}}</td>
                            <td>{{$cal->register->serialnumber}}</td>                                    
                            <td>{{$cal->register->modelofequipament->typeofequipament->type}}</td>
                            <td>{{$cal->register->modelofequipament->model}}</td>
                            <td>{{$cal->laboratory->laboratory}}</td>
                            <td>{{date('M j, Y', strtotime($cal->next_calibration))}}</td>
                            <td>                                
                                <a href="{{route('registers.show',$cal->register_id)}}" class="actions edit">
                                    <button type="button" class="btn btn-info">View</button>
                                </a>                                
                            </td>                            
                        </tr>
                        @endforeach
                    </table>
                    {!! $calibration->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection