@extends('layouts.app')

@section('titulo')
    Indicador
@endsection

@section('breadcrumb')
    <li>Indicador</li>
    <li class="active">Meta X Real</li>
@endsection

@section('container')
    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Indicador - {{ $indicador->indicador }}</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="line_bar"></div>
                </div>
            </div>
        </div>
        <!-- /basic responsive configuration -->
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            // Configuration
            // ------------------------------

            // Charts setup
            function carregarGrafico (echarts) {
                // Initialize charts
                // ------------------------------
                var line_bar = echarts.init(document.getElementById('line_bar'), temaPadrao());


                // Charts options
                // ------------------------------


                //
                // Line and bar combination
                //

                line_bar_options = {

                    // Setup grid
                    grid: {
                        x: 55,
                        x2: 45,
                        y: 35
                    },

                    // Add tooltip
                    tooltip: {
                        trigger: 'axis'
                    },

                    // Enable drag recalculate
                    calculable: true,

                    // Add legend
                    legend: {
                        data: ['Real', 'Meta']
                    },

                    // Horizontal axis
                    xAxis: [{
                        type: 'category',
                        data: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Junho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
                    }],

                    // Vertical axis
                    yAxis: [
                        {
                            type: 'value',
                            name: 'Quantidade',
                            axisLabel: {
                                formatter: '{value} qtde'
                            }
                        }
                    ],

                    // Add series
                    series: [
                        {
                            name: 'Real',
                            type: 'bar',
                            data: [2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
                        },
                        {
                            name: 'Meta',
                            type: 'bar',
                            data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
                        }
                    ]
                };

                // Apply options
                // ------------------------------

                line_bar.setOption(line_bar_options);

                // Resize charts
                // ------------------------------

                window.onresize = function () {
                    setTimeout(function () {
                        line_bar.resize();
                    }, 200);
                }
            }
            carregarGrafico(echarts);
        });
    </script>
@endsection
