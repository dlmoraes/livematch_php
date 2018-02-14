<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Livematch</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/extras/animate.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/headroom/headroom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/headroom/headroom_jquery.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/key_table.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/handsontable/handsontable.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/theme/limitless.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/line.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/bar.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/pie.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/scatter.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/k.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/radar.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/chart/gauge.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
    <!-- /theme JS files -->
    @yield('scripts')
</head>

<body class="pace-done sidebar-xs navbar-top">

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/logo_celpa_preto3_pq.png') }}" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <p class="navbar-text"><span class="label bg-success">Online</span></p>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                                class="img-circle img-sm" alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">Victoria Baker</span>
                                <div class="text-size-mini text-muted">
                                    <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                                </div>
                            </div>

                            <div class="media-right media-middle">
                                <ul class="icons-list">
                                    <li>
                                        <a href="#"><i class="icon-cog3"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                @include('layouts.navegacao')

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span
                                    class="text-semibold"> @yield('titulo')</span> @yield('subtitulo')</h4>
                    </div>

                    <div class="heading-elements">
                        <div class="heading-btn-group">
                            @yield('botoes_extras')
                        </div>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="icon-home2 position-left"></i> Home</a></li>
                        @yield('breadcrumb')
                        {{--<li class="active">Usuários</li>--}}
                    </ul>
                </div>
            </div>
            <!-- /page header -->

        @yield('container')
        <!-- Footer -->
            <div class="footer text-muted">
                &copy; 2018. <a href="#">LiveMatch</a> by <a href="http://www.celpa.com.br"
                                                             target="_blank">Celpa</a>
            </div>
            <!-- /footer -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
