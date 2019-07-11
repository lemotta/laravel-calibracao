@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">                
                <div class="card-header">Report 213</div>
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
                            <tr>
                                <td width="100px"><b>Valor</b></td>
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
                                <td width="100px"><b>+ 5.00V</b></td>
                                <td><font size="1">{!! Form::text('5vdc_pattern', null, ['class' => 'form-control', 'id' => '5vdc_pattern'])!!}</font></td>
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
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'dc_pos_5()'])!!}</td>                                
                            </tr>
                            <tr>
                                <td width="100px"><b>+ 12.00V</b></td>
                                <td><font size="1">{!! Form::text('12vdc_pattern', null, ['class' => 'form-control', 'id' => '12vdc_pattern'])!!}</font></td>
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
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'dc_pos_12()'])!!}</td>
                            </tr>
                            <tr>
                                <td width="100px"><b>- 12.00V</b></td>
                                <td><font size="1">{!! Form::text('n12vdc_pattern', null, ['class' => 'form-control', 'id' => 'n12vdc_pattern'])!!}</font></td>
                                <td>{!! Form::text('n12vdc_l1', null, ['class' => 'form-control', 'id' => 'n12vdc_l1'])!!}</td>
                                <td>{!! Form::text('n12vdc_l2', null, ['class' => 'form-control', 'id' => 'n12vdc_l2'])!!}</td>
                                <td>{!! Form::text('n12vdc_l3', null, ['class' => 'form-control', 'id' => 'n12vdc_l3'])!!}</td>
                                <td>{!! Form::text('n12vdc_l4', null, ['class' => 'form-control', 'id' => 'n12vdc_l4'])!!}</td>
                                <td>{!! Form::text('n12vdc_l5', null, ['class' => 'form-control', 'id' => 'n12vdc_l5'])!!}</td>                                
                                <td>{!! Form::label('n12vdc_media_label', '-', ['id' => 'n12vdc_media_label']) !!}</td>
                                <td>{!! Form::label('n12vdc_ert_label', '-', ['id' => 'n12vdc_ert_label']) !!}</td>
                                {!! Form::hidden('n12vdc_media', null, ['id' => 'n12vdc_media']) !!}
                                {!! Form::hidden('n12vdc_ert', null, ['id' => 'n12vdc_ert']) !!}
                                {!! Form::hidden('n12vdc_status', null, ['id' => 'n12vdc_status']) !!}
                                <td><b><font size="1">{!! Form::label('n12vdc_status_label', '-', ['id' => 'n12vdc_status_label']) !!}</font></b></td>
                                <td>{!! Form::button('calc', ['class' => 'btn btn-primary', 'onclick' => 'dc_neg_12()'])!!}</td>
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