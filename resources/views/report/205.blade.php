@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header">Report 205</div>
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
                    <div class="form-group">
                        <h5 align="center" class="modal-title"><b><font color="blue">EQUIPAMENTO SOB CALIBRAÇÃO</font></b></h5>
                    </div>                    
                    <p class="title-pg"><b>ID : </b>{{$register->department->description}} {{str_pad($register->number,4,'0', STR_PAD_LEFT)}}</p>
                    <p><b>TYPE OF EQUIPAMENT : </b>{{$register->modelofequipament->typeofequipament->type}}</p>
                    <p><b>MANUFACTURER : </b>{{$register->modelofequipament->manufacturer->name}}</p>
                    <p><b>MODEL OF EQUIPAMENT : </b>{{$register->modelofequipament->model}}</p>
                    <p><b>SERIAL NUMBER : </b>{{$register->serialnumber}}</p>
                    <div class="form-group">
                        <h5 align="center" class="modal-title"><b><font color="blue">INSTRUÇÃO UTILIZADA</font></b></h5>
                    </div>                    
                    <p><b>INSTRUCTION : </b>{{$register->instruction->id}} - {{$register->instruction->description}}</p>
                    <div class="form-group">
                        <h5 align="center" class="modal-title"><b><font color="blue">PADRÕES UTILIZADOS</font></b></h5>
                    </div>                   
                    <div class="form-group">
                        {!! Form::select('pattern1_id', $pattern1, null, ['class' => 'form-control']) !!}
                    </div>                    
                    <div class="form-group">
                        <h5 align="center" class="modal-title"><b><font color="blue">RESULTADO DA CALIBRAÇÃO</font></b></h5>
                    </div>
                    <div class="form-group">
                        <table class="table table-report" border="2">                            
                            <tr>
                                <td><b><font size="1">-</font></b></td>
                                <td><b><font size="1">Leitura 1</font></b></td>
                                <td><b><font size="1">Leitura 2</font></b></td>
                                <td><b><font size="1">Leitura 3</font></b></td>
                                <td><b><font size="1">Leitura 4</font></b></td>
                                <td><b><font size="1">Leitura 5</font></b></td>                                
                                <td><b><font size="1">STATUS</font></b></td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>Calcanheira</b></td>
                                <td>{!! Form::checkbox('calcanheira_l1', '1', false, [ 'class' => 'form-control', 'id' => 'calcanheira_l1', 'onclick' => 'check_ok("calcanheira")']) !!}</td>
                                <td>{!! Form::checkbox('calcanheira_l2', '1', false, [ 'class' => 'form-control', 'id' => 'calcanheira_l2', 'onclick' => 'check_ok("calcanheira")']) !!}</td>
                                <td>{!! Form::checkbox('calcanheira_l3', '1', false, [ 'class' => 'form-control', 'id' => 'calcanheira_l3', 'onclick' => 'check_ok("calcanheira")']) !!}</td>
                                <td>{!! Form::checkbox('calcanheira_l4', '1', false, [ 'class' => 'form-control', 'id' => 'calcanheira_l4', 'onclick' => 'check_ok("calcanheira")']) !!}</td>
                                <td>{!! Form::checkbox('calcanheira_l5', '1', false, [ 'class' => 'form-control', 'id' => 'calcanheira_l5', 'onclick' => 'check_ok("calcanheira")']) !!}</td>
                                {!! Form::hidden('calcanheira_status', null, ['id' => 'calcanheira_status']) !!}
                                <td><b><font size="1">{!! Form::label('calcanheira_status_label', '-', ['id' => 'calcanheira_status_label']) !!}</font></b></td>
                            </tr>
                            <tr>
                                <td width="100px"><b>Biqueira</b></td>
                                <td>{!! Form::checkbox('biqueira_l1', '1', false, [ 'class' => 'form-control', 'id' => 'biqueira_l1', 'onclick' => 'check_ok("biqueira")']) !!}</td>
                                <td>{!! Form::checkbox('biqueira_l2', '1', false, [ 'class' => 'form-control', 'id' => 'biqueira_l2', 'onclick' => 'check_ok("biqueira")']) !!}</td>
                                <td>{!! Form::checkbox('biqueira_l3', '1', false, [ 'class' => 'form-control', 'id' => 'biqueira_l3', 'onclick' => 'check_ok("biqueira")']) !!}</td>
                                <td>{!! Form::checkbox('biqueira_l4', '1', false, [ 'class' => 'form-control', 'id' => 'biqueira_l4', 'onclick' => 'check_ok("biqueira")']) !!}</td>
                                <td>{!! Form::checkbox('biqueira_l5', '1', false, [ 'class' => 'form-control', 'id' => 'biqueira_l5', 'onclick' => 'check_ok("biqueira")']) !!}</td>
                                {!! Form::hidden('biqueira_status', null, ['id' => 'biqueira_status']) !!}
                                <td><b><font size="1">{!! Form::label('biqueira_status_label', '-', ['id' => 'biqueira_status_label']) !!}</font></b></td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>Pulseira</b></td>
                                <td>{!! Form::checkbox('pulseira_l1', '1', false, [ 'class' => 'form-control', 'id' => 'pulseira_l1', 'onclick' => 'check_ok("pulseira")']) !!}</td>
                                <td>{!! Form::checkbox('pulseira_l2', '1', false, [ 'class' => 'form-control', 'id' => 'pulseira_l2', 'onclick' => 'check_ok("pulseira")']) !!}</td>
                                <td>{!! Form::checkbox('pulseira_l3', '1', false, [ 'class' => 'form-control', 'id' => 'pulseira_l3', 'onclick' => 'check_ok("pulseira")']) !!}</td>
                                <td>{!! Form::checkbox('pulseira_l4', '1', false, [ 'class' => 'form-control', 'id' => 'pulseira_l4', 'onclick' => 'check_ok("pulseira")']) !!}</td>
                                <td>{!! Form::checkbox('pulseira_l5', '1', false, [ 'class' => 'form-control', 'id' => 'pulseira_l5', 'onclick' => 'check_ok("pulseira")']) !!}</td>
                                {!! Form::hidden('pulseira_status', null, ['id' => 'pulseira_status']) !!}
                                <td><b><font size="1">{!! Form::label('pulseira_status_label', '-', ['id' => 'pulseira_status_label']) !!}</font></b></td>                                
                            </tr>
                            <tr align="center">        
                                <th colspan = "11">{!! Form::submit('save', ['id' => 'save', 'class' => 'btn btn-primary', 'disabled'])!!}</th>
                            </tr>
                        </table>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>            
        </div>        
    </div>
</div>
@endsection