@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">                
                <div class="card-header">Report 324</div>
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
                        {!! Form::select('pattern2_id', $pattern2, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <h5 align="center" class="modal-title"><b><font color="blue">RESULTADO DA CALIBRAÇÃO</font></b></h5>
                    </div>
                    <div class="form-group">
                        <table class="table table-report" border="2">
                            <tr align="center">        
                                <th colspan = "11">Temperatura Ambiente</th>
                            </tr>
                            <tr>
                                <td width="100px"><b>leituras com intervalos de 10 min.</b></td>
                                <td><b><font size="1">Padrão</font></b></td>
                                <td><b><font size="1">Leitura 1</font></b></td>
                                <td><b><font size="1">Leitura 2</font></b></td>
                                <td><b><font size="1">Leitura 3</font></b></td>
                                <td><b><font size="1">Leitura 4</font></b></td>
                                <td><b><font size="1">Leitura 5</font></b></td>
                                <td><b><font size="1">Média</font></b></td>
                                <td><b><font size="1">Erro Total (ErT)</font></b></td>
                                <td><b><font size="1">STATUS</font></b></td>
                                <td><b><font size="1">-</font></b></td>
                            </tr>
                            <tr>
                                <td width="100px"><b>Temperatura</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => 'temp_pattern'])!!}</font></td>
                                <td>{!! Form::text('temp_l1', null, ['class' => 'form-control', 'id' => 'temp_l1'])!!}</td>
                                <td>{!! Form::text('temp_l2', null, ['class' => 'form-control', 'id' => 'temp_l2'])!!}</td>
                                <td>{!! Form::text('temp_l3', null, ['class' => 'form-control', 'id' => 'temp_l3'])!!}</td>
                                <td>{!! Form::text('temp_l4', null, ['class' => 'form-control', 'id' => 'temp_l4'])!!}</td>
                                <td>{!! Form::text('temp_l5', null, ['class' => 'form-control', 'id' => 'temp_l5'])!!}</td>                                
                                <td>{!! Form::label('temp_media_label', '-', ['id' => 'temp_media_label']) !!}</td>
                                <td>{!! Form::label('temp_ert_label', '-', ['id' => 'temp_ert_label']) !!}</td>
                                {!! Form::hidden('temp_media', null, ['id' => 'temp_media']) !!}
                                {!! Form::hidden('temp_ert', null, ['id' => 'temp_ert']) !!}
                                {!! Form::hidden('temp_status', null, ['id' => 'temp_status']) !!}
                                <td><b><font size="1">{!! Form::label('temp_status_label', '-', ['id' => 'temp_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'temperatura()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>Humidade</b></td>
                                <td><font size="1">{!! Form::text('humidity_pattern', null, ['class' => 'form-control', 'id' => 'humidity_pattern'])!!}</font></td>
                                <td>{!! Form::text('humidity_l1', null, ['class' => 'form-control', 'id' => 'humidity_l1'])!!}</td>
                                <td>{!! Form::text('humidity_l2', null, ['class' => 'form-control', 'id' => 'humidity_l2'])!!}</td>
                                <td>{!! Form::text('humidity_l3', null, ['class' => 'form-control', 'id' => 'humidity_l3'])!!}</td>
                                <td>{!! Form::text('humidity_l4', null, ['class' => 'form-control', 'id' => 'humidity_l4'])!!}</td>
                                <td>{!! Form::text('humidity_l5', null, ['class' => 'form-control', 'id' => 'humidity_l5'])!!}</td>
                                <td>{!! Form::label('humidity_media_label', '.', ['id' => 'humidity_media_label']) !!}</td>
                                <td>{!! Form::label('humidity_ert_label', '.', ['id' => 'humidity_ert_label']) !!}</td>
                                {!! Form::hidden('humidity_media', null, ['id' => 'humidity_media']) !!}
                                {!! Form::hidden('humidity_ert', null, ['id' => 'humidity_ert']) !!}
                                {!! Form::hidden('humidity_status', null, ['id' => 'humidity_status']) !!}
                                <td><b><font size="1">{!! Form::label('humidity_status', '-', ['id' => 'humidity_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'humidade()'])!!}</td>
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