<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Livematch</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/logo_celpa_preto3_pq.png') }}" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#">
                    <i class="icon-display4"></i> <span
                            class="visible-xs-inline-block position-right"> Go to website</span>
                </a>
            </li>

            <li>
                <a href="mailto:flavio.moraes@celpa.com.br">
                    <i class="icon-user-tie"></i> <span
                            class="visible-xs-inline-block position-right"> Contact admin</span>
                </a>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cog3"></i>
                    <span class="visible-xs-inline-block position-right"> Options</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                {!! Form::open(['url' => url('/login'), 'role' => 'form', 'method' => 'post']) !!}
                {!! csrf_field() !!}
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-statistics"></i></div>
                        <h5 class="content-group"><strong>Live Match</strong>
                            <small class="display-block">Entre com seus dados de login</small>
                        </h5>
                    </div>
                    <div class="form-group has-feedback has-feedback-left">
                        {!! Form::select('empresa_id', $empresas, null, ['id' => 'empresa_id', 'class' => 'form-control', 'placeholder' => 'Selecione a empresa...']) !!}
                        <div class="form-control-feedback">
                            <i class="icon-house text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        {!! Form::text('login', null, ['id' => 'login', 'class' => 'form-control', 'placeholder' => 'Login de rede']) !!}
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha']) !!}
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Entrar <i
                                    class="icon-circle-right2 position-right"></i></button>
                    </div>
                    <div class="text-center">
                        <a href="login_password_recover.html">Esqueceu a senha?</a>
                    </div>
                </div>
            {!!Form::close() !!}
            <!-- /simple login form -->


                <!-- Footer -->
                <div class="footer text-muted text-center">
                    &copy; 2018. <a href="#">LiveMatch</a> by <a href="http://www.celpa.com.br"
                                                                 target="_blank">Celpa</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
</body>
</html>
