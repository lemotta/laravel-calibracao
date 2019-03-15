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
            <label class="head_logo">Engenharia de Testes e Laboratório de Calibração</label>            
        </div>
        <hr>
        <div class="form-group alert alert-dark">
            <h5>REGISTRO DE CALIBRAÇÃO</h5>
            <h5>Nº {{str_pad($calibration->id,4,'0', STR_PAD_LEFT)}}</h5>
            <h5>{{date('M j, Y', strtotime($calibration->created_at))}}</h5>
        </div>
        <div class="form-group">
            <h6>EQUIPAMENTO SOB CALIBRAÇÃO</h6>
            <p>ID: <em>{{$calibration->register->department->description}} {{str_pad($calibration->register->number,4,'0', STR_PAD_LEFT)}}</em></p>
            <p>Tipo: <em>{{$calibration->register->modelofequipament->typeofequipament->type}}</em></p>            
            <p>Fabricante: <em>{{$calibration->register->modelofequipament->manufacturer->name}}</em></p>
            <p>Modelo: <em>{{$calibration->register->modelofequipament->model}}</em></p>
            <p>Serial: <em>{{$calibration->register->serialnumber}}</em></p>
        </div>
        <div class="form-group">
            <h6>INSTRUÇÃO UTILIZADA</h6>
            <p><em>{{$calibration->register->instruction->id}} - {{$calibration->register->instruction->description}}</em></p>
        </div>
        <div class="form-group">
            <h6>PADRÕES UTILIZADOS</h6>
            @foreach($array_pattern as $pattern)
            <p>ID: <em>{{$pattern->department->description}} {{str_pad($pattern->number,4,'0', STR_PAD_LEFT)}}</em></p>
            <p>Tipo: <em>{{$pattern->modelofequipament->typeofequipament->type}}</em></p>            
            <p>Fabricante: <em>{{$pattern->modelofequipament->manufacturer->name}}</em></p>
            <p>Modelo: <em>{{$pattern->modelofequipament->model}}</em></p>
            <p>Serial: <em>{{$pattern->serialnumber}}</em></p>
            <p>Cert. de Calibração: <em>null</em></p>
            <p>Validade: <em>null</em></p>
            <p>Laborátorio: <em>null</em></p>
            <br>
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
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$result}}</td>
                    </tr>
                    @endif
                    @endforeach
                </table>
            </div>
        </div>
        <div class="form-group">
            <h6>RESULTADO E CONDIÇÕES TÉCNICAS DO EQUIPAMENTO</h6>
            <div class="alert alert-success" style="text-align: center">                
                Equipamento Calibrado e aprovado para uso.
            </div>            
        </div>
        <div class="form-group">
            <h6>EXECUÇÃO E APROVAÇÃO</h6>
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
