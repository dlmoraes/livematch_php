<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SisFeedback</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>SisFeed</b>Back</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Faça login para começar a sua sessão</p>

        {!! Form::open(['url' => url('/login'), 'role' => 'form', 'method' => 'post']) !!}
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                {!! Form::select('empresa_id', $empresas, null, ['id' => 'empresa_id', 'class' => 'form-control select2','placeholder' => 'Selecione a empresa...']) !!}
                <span class="glyphicon glyphicon-building form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::text('login', null, ['id' => 'login', 'class' => 'form-control', 'placeholder' => 'Login']) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        {!! Form::close() !!}

    </div>
    <!-- /.login-box-body -->
</div>
<script src="{{ asset("js/plugins.js") }}"></script>
<script>
    $(function () {
        @if (count($errors) > 0)
            @foreach($errors->all() as $error)
                var msg = "{!! $error !!}";
                mensagem(msg, 'error');
            @endforeach
            function mensagem(msg, tipo) {
                noty({
                    text: msg,
                    layout: 'topRight',
                    type: tipo
                });
            }
        @endif
    });
</script>
</body>
</html>
