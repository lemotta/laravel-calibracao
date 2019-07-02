@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">                
                <div class="card-header">Report 165</div>
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
                                <th colspan = "11">LEITURAS DC</th>
                            </tr>
                            <tr>
                                <td width="100px"><b>Referência</b></td>
                                <td><b><font size="1">Padrão DC</font></b></td>
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
                                <td width="100px"><b>2 VDC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '2vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('2vdc_l1', null, ['class' => 'form-control', 'id' => '2vdc_l1'])!!}</td>
                                <td>{!! Form::text('2vdc_l2', null, ['class' => 'form-control', 'id' => '2vdc_l2'])!!}</td>
                                <td>{!! Form::text('2vdc_l3', null, ['class' => 'form-control', 'id' => '2vdc_l3'])!!}</td>
                                <td>{!! Form::text('2vdc_l4', null, ['class' => 'form-control', 'id' => '2vdc_l4'])!!}</td>
                                <td>{!! Form::text('2vdc_l5', null, ['class' => 'form-control', 'id' => '2vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('2vdc_media_label', '-', ['id' => '2vdc_media_label']) !!}</td>
                                <td>{!! Form::label('2vdc_ert_label', '-', ['id' => '2vdc_ert_label']) !!}</td>
                                {!! Form::hidden('2vdc_media', null, ['id' => '2vdc_media']) !!}
                                {!! Form::hidden('2vdc_ert', null, ['id' => '2vdc_ert']) !!}
                                {!! Form::hidden('2vdc_status', null, ['id' => '2vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('2vdc_status_label', '-', ['id' => '2vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_2vdc()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>5 VDC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '5vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('5vdc_l1', null, ['class' => 'form-control', 'id' => '5vdc_l1'])!!}</td>
                                <td>{!! Form::text('5vdc_l2', null, ['class' => 'form-control', 'id' => '5vdc_l2'])!!}</td>
                                <td>{!! Form::text('5vdc_l3', null, ['class' => 'form-control', 'id' => '5vdc_l3'])!!}</td>
                                <td>{!! Form::text('5vdc_l4', null, ['class' => 'form-control', 'id' => '5vdc_l4'])!!}</td>
                                <td>{!! Form::text('5vdc_l5', null, ['class' => 'form-control', 'id' => '5vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('5vdc_media_label', '-', ['id' => '5vdc_media_label']) !!}</td>
                                <td>{!! Form::label('5vdc_ert_label', '-', ['id' => '5vdc_ert_label']) !!}</td>
                                {!! Form::hidden('5vdc_media', null, ['id' => '5vdc_media']) !!}
                                {!! Form::hidden('5vdc_ert', null, ['id' => '5vdc_ert']) !!}
                                {!! Form::hidden('5vdc_status', null, ['id' => '5vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('5vdc_status_label', '-', ['id' => '5vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_5vdc()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>12 VDC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '12vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('12vdc_l1', null, ['class' => 'form-control', 'id' => '12vdc_l1'])!!}</td>
                                <td>{!! Form::text('12vdc_l2', null, ['class' => 'form-control', 'id' => '12vdc_l2'])!!}</td>
                                <td>{!! Form::text('12vdc_l3', null, ['class' => 'form-control', 'id' => '12vdc_l3'])!!}</td>
                                <td>{!! Form::text('12vdc_l4', null, ['class' => 'form-control', 'id' => '12vdc_l4'])!!}</td>
                                <td>{!! Form::text('12vdc_l5', null, ['class' => 'form-control', 'id' => '12vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('12vdc_media_label', '-', ['id' => '12vdc_media_label']) !!}</td>
                                <td>{!! Form::label('12vdc_ert_label', '-', ['id' => '12vdc_ert_label']) !!}</td>
                                {!! Form::hidden('12vdc_media', null, ['id' => '12vdc_media']) !!}
                                {!! Form::hidden('12vdc_ert', null, ['id' => '12vdc_ert']) !!}
                                {!! Form::hidden('12vdc_status', null, ['id' => '12vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('12vdc_status_label', '-', ['id' => '12vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_12vdc()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>15 VDC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '15vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('15vdc_l1', null, ['class' => 'form-control', 'id' => '15vdc_l1'])!!}</td>
                                <td>{!! Form::text('15vdc_l2', null, ['class' => 'form-control', 'id' => '15vdc_l2'])!!}</td>
                                <td>{!! Form::text('15vdc_l3', null, ['class' => 'form-control', 'id' => '15vdc_l3'])!!}</td>
                                <td>{!! Form::text('15vdc_l4', null, ['class' => 'form-control', 'id' => '15vdc_l4'])!!}</td>
                                <td>{!! Form::text('15vdc_l5', null, ['class' => 'form-control', 'id' => '15vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('15vdc_media_label', '-', ['id' => '15vdc_media_label']) !!}</td>
                                <td>{!! Form::label('15vdc_ert_label', '-', ['id' => '15vdc_ert_label']) !!}</td>
                                {!! Form::hidden('15vdc_media', null, ['id' => '15vdc_media']) !!}
                                {!! Form::hidden('15vdc_ert', null, ['id' => '15vdc_ert']) !!}
                                {!! Form::hidden('15vdc_status', null, ['id' => '15vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('15vdc_status_label', '-', ['id' => '15vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_15vdc()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>19 VDC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '19vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('19vdc_l1', null, ['class' => 'form-control', 'id' => '19vdc_l1'])!!}</td>
                                <td>{!! Form::text('19vdc_l2', null, ['class' => 'form-control', 'id' => '19vdc_l2'])!!}</td>
                                <td>{!! Form::text('19vdc_l3', null, ['class' => 'form-control', 'id' => '19vdc_l3'])!!}</td>
                                <td>{!! Form::text('19vdc_l4', null, ['class' => 'form-control', 'id' => '19vdc_l4'])!!}</td>
                                <td>{!! Form::text('19vdc_l5', null, ['class' => 'form-control', 'id' => '19vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('19vdc_media_label', '-', ['id' => '19vdc_media_label']) !!}</td>
                                <td>{!! Form::label('19vdc_ert_label', '-', ['id' => '19vdc_ert_label']) !!}</td>
                                {!! Form::hidden('19vdc_media', null, ['id' => '19vdc_media']) !!}
                                {!! Form::hidden('19vdc_ert', null, ['id' => '19vdc_ert']) !!}
                                {!! Form::hidden('19vdc_status', null, ['id' => '19vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('19vdc_status_label', '-', ['id' => '19vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_19vdc()'])!!}</td>                                
                            </tr>
                            <tr align="center">        
                                <th colspan = "11">LEITURAS AC</th>
                            </tr>
                            <tr>
                                <td width="100px"><b>Referência</b></td>
                                <td><b><font size="1">Padrão AC</font></b></td>
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
                                <td width="100px"><b>128 VAC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '128vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('128vdc_l1', null, ['class' => 'form-control', 'id' => '128vdc_l1'])!!}</td>
                                <td>{!! Form::text('128vdc_l2', null, ['class' => 'form-control', 'id' => '128vdc_l2'])!!}</td>
                                <td>{!! Form::text('128vdc_l3', null, ['class' => 'form-control', 'id' => '128vdc_l3'])!!}</td>
                                <td>{!! Form::text('128vdc_l4', null, ['class' => 'form-control', 'id' => '128vdc_l4'])!!}</td>
                                <td>{!! Form::text('128vdc_l5', null, ['class' => 'form-control', 'id' => '128vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('128vdc_media_label', '-', ['id' => '128vdc_media_label']) !!}</td>
                                <td>{!! Form::label('128vdc_ert_label', '-', ['id' => '128vdc_ert_label']) !!}</td>
                                {!! Form::hidden('128vdc_media', null, ['id' => '128vdc_media']) !!}
                                {!! Form::hidden('128vdc_ert', null, ['id' => '128vdc_ert']) !!}
                                {!! Form::hidden('128vdc_status', null, ['id' => '128vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('128vdc_status_label', '-', ['id' => '128vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_128vdc()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>228 VAC</b></td>
                                <td><font size="1">{!! Form::text('temp_pattern', null, ['class' => 'form-control', 'id' => '228vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('228vdc_l1', null, ['class' => 'form-control', 'id' => '228vdc_l1'])!!}</td>
                                <td>{!! Form::text('228vdc_l2', null, ['class' => 'form-control', 'id' => '228vdc_l2'])!!}</td>
                                <td>{!! Form::text('228vdc_l3', null, ['class' => 'form-control', 'id' => '228vdc_l3'])!!}</td>
                                <td>{!! Form::text('228vdc_l4', null, ['class' => 'form-control', 'id' => '228vdc_l4'])!!}</td>
                                <td>{!! Form::text('228vdc_l5', null, ['class' => 'form-control', 'id' => '228vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('228vdc_media_label', '-', ['id' => '228vdc_media_label']) !!}</td>
                                <td>{!! Form::label('228vdc_ert_label', '-', ['id' => '228vdc_ert_label']) !!}</td>
                                {!! Form::hidden('228vdc_media', null, ['id' => '228vdc_media']) !!}
                                {!! Form::hidden('228vdc_ert', null, ['id' => '228vdc_ert']) !!}
                                {!! Form::hidden('228vdc_status', null, ['id' => '228vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('228vdc_status_label', '-', ['id' => '228vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'report_165_228vdc()'])!!}</td>                                
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