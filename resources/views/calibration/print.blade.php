<!DOCTYPE html>
<html>
    <head>
        <link href="/var/www/html/laravel-calibracao/public/assets/register/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Formulario</title>
    </head>
    <body>
        <div class="head_logo">
            <img src="/var/www/html/laravel-calibracao/storage/app/public/logo.png" class="head_logo">
            <label class="head_logo float-right">
                Engenharia de Testes e Laboratório de Calibração
            </label>            
        </div>
        <hr>
        <div class="form-group alert alert-dark">
            <h5>
                REGISTRO DE CALIBRAÇÃO
            </h5>
            <h5>
                Nº {{str_pad($calibration->id,4,'0', STR_PAD_LEFT)}}
            </h5>
            <h5>
                {{date('M j, Y', strtotime($calibration->created_at))}}
            </h5>
        </div>
        <div class="form-group title-pg">
            <p class="negrito">
                EQUIPAMENTO SOB CALIBRAÇÃO
            </p>
            <div class="form-group">                                    
                <p>
                    <b>ID: </b>
                    <em>
                        {{$calibration->register->department->description}} {{str_pad($calibration->register->number,4,'0', STR_PAD_LEFT)}}
                    </em>
                </p>
                <p>
                    <b>Tipo: </b>
                    <em>
                        {{$calibration->register->modelofequipament->typeofequipament->type}}
                    </em>
                </p>            
                <p>
                    <b>Fabricante: </b>
                    <em>
                        {{$calibration->register->modelofequipament->manufacturer->name}}
                    </em>
                </p>
                <p>
                    <b>Modelo: </b>
                    <em>
                        {{$calibration->register->modelofequipament->model}}
                    </em>
                </p>
                <p>
                    <b>Serial: </b>
                    <em>
                        {{$calibration->register->serialnumber}}
                    </em>
                </p>
            </div>
            <div class="form-group">
                <p class="negrito">INSTRUÇÃO UTILIZADA</p>
                <p style="text-align: center">
                    <em>
                        {{$calibration->register->instruction->id}} - {{$calibration->register->instruction->description}}
                    </em>
                </p>
            </div>
            <div class="form-group title-pg">
                <p class="negrito">
                    PADRÕES UTILIZADOS
                </p>
                @foreach($patterns as $pattern)
                <p>
                    <b>ID: </b>
                    <em>
                        @if(isset($pattern->department->description))
                        {{$pattern->department->description}} {{str_pad($pattern->number,4,'0', STR_PAD_LEFT)}}
                        @else
                        {{$pattern->register->department->description}} {{str_pad($pattern->register->number,4,'0', STR_PAD_LEFT)}}
                        @endif
                    </em>
                </p>
                <p>
                    <b>Tipo: </b>
                    <em>
                        @if(isset($pattern->modelofequipament->typeofequipament->type))
                        {{$pattern->modelofequipament->typeofequipament->type}}
                        @else
                        {{$pattern->register->modelofequipament->typeofequipament->type}}
                        @endif
                    </em>
                </p>            
                <p>
                    <b>Fabricante: </b>
                    <em>
                        @if(isset($pattern->modelofequipament->manufacturer->name))
                        {{$pattern->modelofequipament->manufacturer->name}}
                        @else
                        {{$pattern->register->modelofequipament->manufacturer->name}}
                        @endif
                    </em>
                </p>
                <p>
                    <b>Modelo: </b>
                    <em>
                        @if(isset($pattern->modelofequipament->model))
                        {{$pattern->modelofequipament->model}}
                        @else
                        {{$pattern->register->modelofequipament->model}}
                        @endif
                    </em>
                </p>
                <p>
                    <b>Serial: </b>
                    <em>
                        @if(isset($pattern->serialnumber))
                        {{$pattern->serialnumber}}
                        @else
                        {{$pattern->register->serialnumber}}
                        @endif
                    </em>
                </p>
                <p>
                    <b>Cert. de Calibração: </b>
                    @if( isset($pattern->certificate_calibration) )
                    <em>
                        {{ $pattern->certificate_calibration }}
                    </em>
                    @else
                    <em>
                        Equipamento ajustado momento da utilização.
                    </em>
                    @endif
                </p>
                @if( isset($pattern->next_calibration) )
                <p>
                    <b>Validade: </b>                    
                    <em>
                        {{ date('M j, Y', strtotime($pattern->next_calibration)) }}
                    </em>                    
                </p>
                @endif
                @if( isset($pattern->laboratory_id) )
                <p>
                    <b>Laborátorio: </b>
                    <em>
                        {{ $pattern->laboratory->laboratory }}
                    </em>
                </p>
                @endif
                <hr>
                @endforeach            
            </div>
            <div class="form-group">            
                <div class="form-group">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2" style="text-align: center">Resultados da Calibração</th>
                        </tr>
                        @foreach( $results as $key => $result )
                        @if( strcmp($result,"APROVADO") == 0 )
                        <tr>
                            <td>{{$key}}</td>
                            <th class="aprovado">{{$result}}</th>                                                
                        </tr>
                        <tr>
                            <td style="text-align: center">-</td>
                            <td style="text-align: center">-</td>
                        </tr>
                        @else
                        @if( strcmp($result,"REPROVADO") == 0 )
                        <tr>
                            <td>{{$key}}</td>
                            <th class="reprovado">{{$result}}</th>                                                
                        </tr>
                        <tr>
                            <td style="text-align: center">-</td>
                            <td style="text-align: center">-</td>
                        </tr>
                        @else
                        @if(isset($result))
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$result}}</td>
                        </tr>
                        @endif
                        @endif                    
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="form-group">
                <p class="negrito">
                    RESULTADO E CONDIÇÕES TÉCNICAS DO EQUIPAMENTO
                </p>
                @if( strcmp($status,"APROVADO") == 0 )                
                <div class="alert alert-success" style="text-align: center">                
                    Equipamento Calibrado e aprovado para uso.
                </div>
                @else
                <div class="alert alert-danger" style="text-align: center">                
                    Equipamento desclassificado, não usar;
                </div>
                @endif
            </div>
            <div class="form-group">
                <p class="negrito">
                    EXECUÇÃO E APROVAÇÃO
                </p>
                <div class="form-group" style="text-align: center">                
                    <p>{{ Auth::user()->name }}</p>
                    <p>Período entre Calibração (Meses): {{$calibration->register->period->period_at_month}}</p>
                    <p>Próxima Calibração: {{date('M j, Y', strtotime($calibration->next_calibration))}}</p>
                </div>                        
            </div>        
    </body>
</html>
<!--/var/www/html/laravel-calibracao/public/assets/register/css/style.css--!>
<!--{{ asset('assets/register/css/style.css') }}--!>
<!--/var/www/html/laravel-calibracao/storage/app/public/logo.png--!>
<!--{{ asset('storage/logo.png') }}--!>
