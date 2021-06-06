<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poll-{{ $customer->name."-".$customer->last_name }}</title>
    <link rel="icon" href="{{ public_path('img/polling.svg') }}" type="image/x-icon"/>

    <style>
        table {
           border: 0.00001px solid #000;
        }
        #botones{
            width: 40em;
            height: 3%;
            padding-top:0.5em;
            padding-left: 6em;

        }
        input{
            font-size: 0.9em; /* Let's say this computes to 16px */
            padding: 0.625em 1em; /* 0.1875 * 16 = 10px */
            border-radius: 100%; /* 0.1875 * 16 = 3px */
        }

        #circulos{
            width: 10em;
            height: 10em;
            padding-left: 1em;
            padding-bottom: 1em;
        }
        .circulo{
            width: 0.2em;
            height: 0.2em;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            background-color: #848484;
            margin:0.5em;
            display: inline-block;
        }
        .circulo-select{
            background-color: rgb(221, 42, 42);
            border: 1px solid rgb(221, 42, 42);
            color:#fff;
            font-weight: bold;
        }
        body{
            font:'Open Sans', Arial, Helvetica, sans-serif;
        }
        /* .page-break {
            page-break-after: always;
        } */
</style>
</head>
<body>
    <table align="center" width="100%" cellpadding="0" cellspacing="0">
        <tr style="text-align: left">
            <td colspan="4"><h5 style="text-align: center"><img style="text-align: left; padding-bottom:5px;" src="{{ public_path('img/polling.svg') }}" width="5%" alt=""><br><span style="font-size:20px;">Tdatos</span>  <br>  <br> {{ $poll_info->name }} <br> Codigo: {{ $prefix }}</h5></td>
        </tr>
        <tr style="text-align: left">
            <td style="text-align: left; padding-left:5px;">Nombre del Ciente:</td>
            <td>{{ $customer->name.' '.$customer->last_name }}</td>
            <td>Codigo</td>
            <td>{{ $customer->code }}</td>
        </tr>
        <tr style="text-align: left">
            <td style="color: #ff0000; padding-left:5px;">Encuestado:</td>
            <td>{{ $card->respondent ?? '' }}</td>
            <td>Celular</td>
            <td >{{ $customer->mobile }}</td>
        </tr>
        <tr style="text-align: left">
            <td style="text-align: left; padding-left:5px;">Direccion:</td>
            <td>{{ $customer->address }}</td>
            <td>Telefono</td>
            <td>{{ $customer->phone }}</td>
        </tr>
        <tr style="text-align: left">
            <td style="text-align: left; padding-left:5px;">Email:</td>
            <td>{{ $customer->email }}</td>
            <td>N° de Medidor:</td>
            <td>{{ $customer->number_measurer }}</td>
        </tr>
        <tr style="text-align: left">
            <td style="text-align: left; padding-left:5px;">Promedio KWh:</td>
            <td>{{ $customer->half }}</td>
            <td>Tarifa:</td>
            <td>{{ $customer->rate }}</td>
        </tr>
        <tr style="text-align: left">
            <td style="text-align: left; padding-left:5px;">Fecha de Encuesta:</td>
            <td>{{ $card->date ?? '' }}</td>
            <td>Encuestador:</td>
            <td>{{ $pollster->name." ".$pollster->last_name }}</td>
        </tr>
        <tr style="text-align: left">
            <td colspan="4" style="text-align: left; padding-left:5px;"><h5 style="text-align: left">Observaciones: {{ $customer->observation }}</h5></td>
        </tr>
    </table>
    <h4 style="text-align: center;"> Estimado usuario </h4>
    <span style="text-align: justify;"> {{ $poll_info->description }} </span>
    <br>
    <br>
    <span style="text-align: justify;"> Es necesario, que en los siguientes minutos nos transmita su percepción respecto de la calidad técnica y comercial del servicio eléctrico que hasta ahora le ha brindado EMPRESA, contestando a las siguientes preguntas:</span>
    @php $i=1; @endphp

    @foreach ($polls as $poll)
        <h5 style="text-align: justify"> {{ $poll['name'] }} </h5>
        @foreach ($poll['questions'] as $question)
            <p style="text-align: left; font-size:14px;"> <b>{{ $i++ }}.</b> {{ $question['name'] }} </p>
            <p style="text-align: left; font-size:12px; margin-left:10px;"> {{ $question['description'] }} </p>

                @if (isset($question['frecuency']))
                <div id="botones">
                    @foreach ($question['frecuency'] as $frecuency)
                        @if (isset($question['value']))
                            <input type="button" id="play_one" class="{{ ($frecuency==$question['value']) ? 'circulo-select': '' }}" value=" {{ $frecuency }}">
                        @endif
                    @endforeach
                </div>
                @endif
                @if(isset($question['options']))
                    @php $j=1; @endphp
                    @foreach ($question['options'] as $option)
                        <p style="text-align: justify"> <b>{{ $j++ }}. {{ $option['name'] }}</b></p>
                            @if(isset($option['items']))
                                @foreach ($option['items'] as $item)
                                    @if ($item['value']=='si')
                                        <p style="text-align: justify font-size:13px;"> <img src="{{ ($item['value']=='si') ?  public_path('img/check.png') : public_path('img/check.png') }}" width="24px" alt="" align="middle"> {{ $item['name'] }}</p>
                                    @endif
                                @endforeach
                            @endif
                    @endforeach
                @endif
        @endforeach
    @endforeach
    <br>
    <br>
    <table align="center" width="50%">
        <tr style="text-align: justify">
            <td colspan="4">
                <h5 style="text-align: center"> Encuestado </h5>
                @php  $img = $card->img ?? 'default.svg'; @endphp
                <h5 style="text-align: center"><img src="{{ public_path('upload/card/'.$img) }}" width="50%" alt=""></h5>
            </td>
        </tr>
    </table>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 800, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
    <div class="page-break" style="text-align: center; font-weight:normal important!; font-size:10px;"></div>
</body>
</html>
{{-- <img src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Q1','Q2','Q3','Q4'], datasets:[{label:'Users',data:[50,60,70,180]},{label:'Revenue',data:[100,200,300,400]}]}}" width="50%" alt="">--}}
