@php
set_time_limit(0);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polls</title>
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
        <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border: none !important;">
            @php  $j=1; @endphp
            @php $k = 0; @endphp
            @foreach ($cantons as $tab)
                <tr style="text-align: left; font-weight:bold;">
                    <td colspan="14"><h5 style="text-align: center; font-weight:bold;"><img style="text-align: left; padding-bottom:5px;" src="{{ asset('img/polling.svg') }}" width="5%" alt=""><br><span style="font-size:20px;">TDATOS</span><br><br> {{ $tab['poll'] }}</h5></td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="14"><h5 style="text-align: center; font-weight:bold;">TABULACIÓN DE ENCUESTAS DE  SATISFACCIÓN DEL CONSUMIDOR PARA USUARIOS RESIDENCIALES Y COMERCIALES: (TODOS) <br><br> PERIODO: {{ $tab['period'] }} </h5></td>
                </tr>
                @if ($tab['sections'])
                @php  $i=1; @endphp
                    @foreach ($tab['sections'] as $section)
                        @if ($section['questions'])
                            @foreach ($section['questions'] as $question)
                                @if ($question['type']=="close")
                                    <tr style="text-align: center">
                                        <td colspan="14" style="text-align: center; font-weight:bold; border: solid #000 0.5px !important;"><h4 style="text-align: center; font-weight:bold;">{{ $i++.") ".$question['name'] }}</h4></td>
                                    </tr>
                                    <tr style="text-align: center; border: solid #000 0.5px !important;">
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">1</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">2</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">3</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">4</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">5</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">6</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">7</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">8</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">9</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">10</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">Total</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">&lt;7</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">>=7</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold;">%</h4></td>
                                    </tr>
                                    <tr style="text-align: center; border: solid #000 0.5px !important;">
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_1'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_1'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_2'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_2'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_3'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_3'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_4'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_4'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_5'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_5'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_6'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_6'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_7'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_7'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_8'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_8'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_9'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_9'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['item_10'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['item_10'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['total'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['total'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['menor_a_7'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['menor_a_7'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['mayor_o_igual_a_7'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['mayor_o_igual_a_7'] }}</h4></td>
                                        <td style="text-align: center; border: solid #000 0.5px !important;"  width="7.14%"><h4 style="text-align: center; font-weight:bold; color:{{ ($question['percent'] == "0") ? '#f35466' : '#177dff' }}">{{ $question['percent'] }}</h4></td>
                                    </tr>
                                    <tr style="text-align: left">
                                        <td colspan="14">
                                            <div class="chart-container" style="min-height: 375px">
                                                <canvas id="myLineChart_{{ $j++ }}"></canvas>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr style="text-align: center">
                                        <td colspan="14" style="text-align: center; font-weight:bold; border: solid #000 0.5px !important;"><h4 style="text-align: center; font-weight:bold;">{{ $i++.") ".$question['name'] }}</h4></td>
                                    </tr>
                                    @if ($question['options'])
                                        @foreach ($question['options'] as $option)
                                            <tr style="text-align: center; border: solid #000 0.5px !important;">
                                                <td colspan="5" style="text-align: center; font-weight:bold; border: solid #000 0.5px !important;"><h4 style="text-align: center; font-weight:bold;">{{ $option['name'] }}</h4></td>
                                                <td colspan="9" style="text-align: left; margin-left:10px; font-size:12px font-weight:bold; border: solid #000 0.5px !important;">
                                                    <p style="text-align: left; margin-left:10px; font-size:12px">
                                                        @if ($option['items'])
                                                            @foreach ($option['items'] as $item)
                                                                {{ $item['id'].") ".$item['name'] }}<br>
                                                            @endforeach
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style="text-align: left">
                                                <td colspan="14">
                                                    <div class="chart-container">
                                                        <canvas id="myLineChartOpen_{{ $k++ }}"></canvas>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>
        <br>
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

@php  $j=1; @endphp
@php $k = 0; @endphp
@foreach ($cantons as $tab)
    @if ($tab['sections'])
        @php $sectdata = array(); @endphp
        @php $sections = array(); @endphp
        @php $porc =0; @endphp
        @foreach ($tab['sections'] as $section)
            @if ($section['questions'])
                @foreach ($section['questions'] as $question)
                    @if ($question['type']=="close")
                        <script>
                            //Chart
                            var lineQuestion = document.getElementById('myLineChart_{{ $j++ }}').getContext('2d');

                            var myLineChart = new Chart(lineQuestion, {
                                type: 'line',
                                data: {
                                    labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "<7", ">=7"],
                                    datasets: [{
                                        label:'{{ $question["name"]." ".$question["percent"]."%" }}',
                                        borderColor: "#1d7af3",
                                        pointBorderColor: "#FFF",
                                        pointBackgroundColor: "#1d7af3",
                                        pointBorderWidth: 2,
                                        pointHoverRadius: 4,
                                        pointHoverBorderWidth: 1,
                                        pointRadius: 4,
                                        backgroundColor: 'transparent',
                                        fill: true,
                                        borderWidth: 2,
                                        data: ['{{ $question["item_1"] }}','{{ $question["item_2"] }}', '{{ $question["item_3"] }}', '{{ $question["item_4"] }}', '{{ $question["item_5"] }}', '{{ $question["item_6"] }}', '{{ $question["item_7"] }}', '{{ $question["item_8"] }}', '{{ $question["item_9"] }}', '{{ $question["item_10"] }}', '{{ $question["menor_a_7"] }}', '{{ $question["mayor_o_igual_a_7"] }}'],
                                    }]
                                },
                                options : {
                                    plugins: {
                                        datalabels: {
                                            color: 'black',
                                            anchor: 'end',
                                            clamp: true,
                                            align: 'top',
                                        }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    legend: {
                                        position: 'top',
                                        labels : {
                                            padding: 10,
                                            fontColor: '#1d7af3',
                                        }
                                    },
                                    tooltips: {
                                        bodySpacing: 4,
                                        mode:"nearest",
                                        intersect: 0,
                                        position:"nearest",
                                        xPadding:10,
                                        yPadding:10,
                                        caretPadding:10
                                    },
                                    layout:{
                                        padding:{left:15,right:15,top:15,bottom:15}
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                            drawBorder: false,
                                            color: ['white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'white', 'green', 'white','white',]
                                            },
                                            min: 0,
                                            max: 100,
                                            ticks: {
                                            stepSize: 10
                                            }
                                        }]
                                    }
                                }
                            });

                        </script>
                    @else
                        @if ($question['options'])
                            @php $k = 0; @endphp
                            @foreach ($question['options'] as $option)
                                @if ($option['items'])
                                    @php $items = array(); @endphp
                                    @php $data = array(); @endphp
                                    @php $z = 1; @endphp
                                    @foreach ($option['items'] as $item)
                                        @php $items [] =  $item['id'];  @endphp
                                        @php $data []  =  $item['total'];  @endphp
                                    @endforeach
                                @endif
                                <script>
                                    //Chart
                                    var items = JSON.parse('<?php echo addslashes(json_encode($items, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>');
                                    var data = JSON.parse('<?php echo addslashes(json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT)) ?>');
                                    var lineQuestionOpen = document.getElementById('myLineChartOpen_{{ $k++ }}').getContext('2d');
                                    var myLineChartOpen = new Chart(lineQuestionOpen, {
                                        type: 'line',
                                        data: {
                                            labels: items,
                                            datasets: [{
                                                label:'{{ $option["name"] }}',
                                                borderColor: "#1d7af3",
                                                pointBorderColor: "#FFF",
                                                pointBackgroundColor: "#1d7af3",
                                                pointBorderWidth: 2,
                                                pointHoverRadius: 4,
                                                pointHoverBorderWidth: 1,
                                                pointRadius: 4,
                                                backgroundColor: 'transparent',
                                                fill: true,
                                                borderWidth: 2,
                                                data: data,
                                            }]
                                        },
                                        options : {
                                            plugins: {
                                                datalabels: {
                                                    color: 'black',
                                                    anchor: 'end',
                                                    clamp: true,
                                                    align: 'top',
                                                }
                                            },
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            legend: {
                                                position: 'top',
                                                labels : {
                                                    padding: 10,
                                                    fontColor: '#1d7af3',
                                                }
                                            },
                                            tooltips: {
                                                bodySpacing: 4,
                                                mode:"nearest",
                                                intersect: 0,
                                                position:"nearest",
                                                xPadding:10,
                                                yPadding:10,
                                                caretPadding:10
                                            },
                                            layout:{
                                                padding:{left:15,right:15,top:15,bottom:15}
                                            }
                                        }
                                    });

                                </script>
                            @endforeach
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
@endforeach
</html>
