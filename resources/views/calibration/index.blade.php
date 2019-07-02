@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-body">                    
                    <table class="table table-striped">
                        <tr>        
                            <th>ID</th>        
                            <th>Serial</th>
                            <th>Type</th>
                            <th>Model</th>
                            <th>Laboratory</th>
                            <th>Next Calibration</th> 
                            <th>Actions</th>
                        </tr>
                        @foreach($calibration as $cal)
                        <tr>        
                            <td class="title-pg">{{$cal->register->department->description}} {{str_pad($cal->register->number,4,'0', STR_PAD_LEFT)}}</td>
                            <td>{{$cal->register->serialnumber}}</td>                                    
                            <td>{{$cal->register->modelofequipament->typeofequipament->type}}</td>
                            <td>{{$cal->register->modelofequipament->model}}</td>
                            <td>{{$cal->laboratory->laboratory}}</td>
                            <td>{{date('M j, Y', strtotime($cal->next_calibration))}}</td>
                            <td>                                
                                <a href="{{route('registers.edit',$cal->register_id)}}" class="actions edit">
                                    <button type="button" class="btn btn-info">Register</button>
                                </a>
                                <a href="{{route('registers.show',$cal->register_id)}}" class="actions edit">
                                    <button type="button" class="btn btn-info">View</button>
                                </a>
                                @if( isset($cal->register->report_id) )
                                <a href="{{ route('calibration.print', $cal->id) }}" class="actions edit">
                                    <button type="button" class="btn btn-info">Report</button>
                                </a>
                                @endif
                                <a href="{{route('calibration.tag',$cal->id)}}" class="actions edit">
                                    <button type="button" class="btn btn-info">Print</button>
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