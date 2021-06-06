<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polls Indexes</title>
    <link rel="icon" href="{{ public_path('img/polling.svg') }}" type="image/x-icon"/>
    <link rel="icon" href="{{ asset('img/polling.svg') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/azzara.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugin/printjs/print.min.css') }}">
    <style>
        .btn-whatsapp {
               display:block;
               width:70px;
               height:70px;
               color:#fff;
               position: fixed;
               right:20px;
               //bottom:20px;
               border-radius:50%;
               line-height:80px;
               text-align:center;
               z-index:999;
               cursor: pointer;
        }
    </style>
</head>
<body style="background: #fff;">
    <div class="btn-whatsapp" onclick="printJS('printJS-table', 'html')">
        <img src="{{ asset('img/pdf.svg') }}">
    </div>
    <div class="container" id="printJS-table">

        @foreach ($cantons as $tab)
            @if ($tab['sections'])
            <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border: none !important;">
                <tr style="text-align: center; border: none !important;">
                    <td colspan="5"><img style="text-align: left; padding-bottom:5px;" src="{{ asset('img/polling.svg') }}" width="5%" alt=""><br><span style="text-align: center; font-size:14px; font-weight:bold;">CÁLCULO DE INDICE DE SATISFACCIÓN AL CLIENTE AGENCIA <br>  {{ $tab['canton'] }}</span></td>
                </tr>
            </table>
            <br><br>
                    @foreach ($tab['sections'] as $section)
                        <h5 style="text-align: left; font-weight:bold;">{{ $section['id'].". ".$section['name'] }} </h5>
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border: solid #000000 0.5px !important;">
                            <tr style="text-align: cent; border: solid #000 0.5px !important;">
                                <td style="border: solid #000 0.5px !important;"><p style="text-align: left; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">N°</p></td>
                                <td style="border: solid #000 0.5px !important;"><p style="text-align: left; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">PREGUNTA</p></td>
                                <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">TOTAL</p></td>
                                <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">&lt;7</p></td>
                                <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">>=7</p></td>
                                <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">PORCENTAJE (%)</p></td>
                            </tr>

                            @if ($section['questions'])
                                @php  $i=1; @endphp
                                @php  $average=0; @endphp
                                @foreach ($section['questions'] as $question)
                                    @if ($question['type']=="close")
                                    @php $average += (($question['mayor_o_igual_a_7']/$question['total'])*100) @endphp
                                    <tr style="text-align: cent; border: solid #000 0.5px !important;">
                                        <td style="border: solid #000 0.5px !important;"    width="5%"><p style="text-align: left; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ "P".$i++ }}</p></td>
                                        <td style="border: solid #000 0.5px !important;"  width="50%"><p style="text-align: left; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ $question['name'] }}</p></td>
                                        <td style="border: solid #000 0.5px !important;"  width="10%"><p style="text-align: center; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ $question['total'] }}</p></td>
                                        <td style="border: solid #000 0.5px !important;"  width="10%"><p style="text-align: center; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ $question['menor_a_7'] }}</p></td>
                                        <td style="border: solid #000 0.5px !important;"  width="10%"><p style="text-align: center; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ $question['mayor_o_igual_a_7'] }}</p></td>
                                        <td style="border: solid #000 0.5px !important;"  width="15%"><p style="text-align: center; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ sprintf('%0.2f', ($question['mayor_o_igual_a_7']/$question['total'])*100) }}</p></td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                            <tr style="text-align: center; border: solid #000 0.5px !important;">
                                <td style="border: solid #000 0.5px !important;" colspan="5"   width="5%"><p style="text-align: center; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">TOTAL</p></td>
                                <td style="border: solid #000 0.5px !important;"  width="50%"><p style="text-align: center; margin-left:10px; font-size:12px; font-weight:bold; font-size:12px;">{{ sprintf('%0.2f', $average/count($section['questions'])) }}</p></td>
                            </tr>
                        </table>
                        <br>
                        <h5 style="text-align: left; font-weight:bold;">GRAFICO DE {{ $section['id'].". ".$section['name'] }} </h5>
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border: none !important;">
                            <tr style="text-align: center; border: none !important;">
                                <td colspan="6"><span style="text-align: center; font-size:14px; font-weight:bold;">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="myBarChartSection_{{ $section['id'] }}"></canvas>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endforeach
            @endif
        @endforeach
        <!--   results finals   -->
        <h5 style="text-align: left; font-weight:bold;">RESULTADOS FINALES </h5>
        @foreach ($cantons as $tab)
            @if ($tab['sections'])
            <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border: solid #000000 0.5px !important;">
                <tr style="text-align: cent; border: solid #000 0.5px !important;">
                    <td style="border: solid #000 0.5px !important;"><p style="text-align: left; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">N°</p></td>
                    <td style="border: solid #000 0.5px !important;"><p style="text-align: left; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">SECCIONES</p></td>
                    <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">PORCENTAJE (%)</p></td>
                </tr>
                @php  $total_average=0; @endphp
                @foreach ($tab['sections'] as $section)
                        @if ($section['questions'])
                            @php  $i=1; @endphp
                            @php  $average=0; @endphp
                            @foreach ($section['questions'] as $question)
                                @if ($question['type']=="close")
                                    @php $average += (($question['mayor_o_igual_a_7']/$question['total'])*100) @endphp
                                @endif
                            @endforeach
                        @endif
                        <tr style="text-align: cent; border: solid #000 0.5px !important;">
                            <td style="border: solid #000 0.5px !important;"><p style="text-align: left; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">{{ $section['id'] }}</p></td>
                            <td style="border: solid #000 0.5px !important;"><p style="text-align: left; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">{{ $section['name'] }}</p></td>
                            <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">{{ sprintf('%0.2f', $average/count($section['questions'])) }}</p></td>
                        </tr>
                @php  $total_average+=($average/count($section['questions'])); @endphp
                @endforeach
                        <tr style="text-align: center; border: solid #000 0.5px !important;">
                            <td style="border: solid #000 0.5px !important;" colspan="2"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">TOTAL</p></td>
                            <td style="border: solid #000 0.5px !important;"><p style="text-align: center; margin-left:10px; font-size:14px; font-weight:bold; font-size:14px;">{{ sprintf('%0.2f', $total_average/count($tab['sections'])) }}</p></td>
                        </tr>
            </table>
            <br>
            @endif
        @endforeach
        <h5 style="text-align: left; font-weight:bold;">GRAFICO DE RESULTADO FINAL</h5>
        <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border: none !important;">
            <tr style="text-align: center; border: none !important;">
                <td colspan="6"><span style="text-align: center; font-size:14px; font-weight:bold;">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="myBarChartSection"></canvas>
                    </div>
                </td>
            </tr>
        </table>
        <br>
        <!--   results finals   -->
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bundle.min.js') }}"></script>
<script src="{{ asset('js/plugin/printjs/print.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('js/plugin/chart.js/chartjs-plugin-datalabels@0.7.0') }}"></script>

    @foreach ($cantons as $tab)
        @if ($tab['sections'])
            @php $sections = array(); @endphp
            @php $sectdata = array(); @endphp
            @php  $total_average=0; @endphp

            @foreach ($tab['sections'] as $section)
                @php $sections [] = $section['id']; @endphp
                @if ($section['questions'])
                    @php $i= 1; @endphp
                    @php $average= 0; @endphp
                    @php $less = 0; @endphp
                    @php $high = 0; @endphp
                    @php $total = 0; @endphp
                    @php $questdata = array(); @endphp
                    @php $questions = array(); @endphp

                        @foreach ($section['questions'] as $question)
                            @if ($question['type']=="close")
                                @php $average += (($question['mayor_o_igual_a_7']/$question['total'])*100) @endphp
                                @php $total +=$question['total']; @endphp
                                @php $less +=$question['menor_a_7']; @endphp
                                @php $high +=$question['mayor_o_igual_a_7']; @endphp
                                @php $questions[]= "P".$i++; @endphp
                                @php $questdata[]= sprintf('%0.2f', ($question['mayor_o_igual_a_7']/$question['total'])*100); @endphp
                            @endif
                        @endforeach
                        @php $sectdata [] = sprintf('%0.2f', $average/count($section['questions'])); @endphp
                        @php $questions [] = 'Total'; @endphp
                        @php $questdata [] = sprintf('%0.2f', $average/count($section['questions'])); @endphp
                @endif
                @php  $total_average+=($average/count($section['questions'])); @endphp
                <script>
                    var questions = JSON.parse('<?php echo addslashes(json_encode($questions, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>');
                    var questdata = JSON.parse('<?php echo addslashes(json_encode($questdata, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>');
                    var ctx = document.getElementById("myBarChartSection_{{ $section['id'] }}");
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: questions,
                            datasets: [{
                                label: '{{ $section['name'] }}',
                                data: questdata,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        plugins: [ChartDataLabels],
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }],
                                xAxes: [{
                                   /*  gridLines: {
                                        drawBorder: true,
                                        color: color
                                    }, */
                                    min: 0,
                                    max: 100,
                                    ticks: {
                                        stepSize: 10
                                    }
                                }]
                            },
                        }
                    });
                </script>
            @endforeach
        @endif
        @php $sections [] = 'Total '.$tab['code']." ".$tab['canton']  @endphp
        @php $sectdata [] = sprintf('%0.2f', $total_average/count($tab['sections'])); @endphp

        <script>
            var sections = JSON.parse('<?php echo addslashes(json_encode($sections, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>');
            var data = JSON.parse('<?php echo addslashes(json_encode($sectdata, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>');

            var ctx = document.getElementById("myBarChartSection");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: sections,
                    datasets: [{
                        label: '{{ $tab['code']." ".$tab['canton'] }}',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>
    @endforeach
</html>
