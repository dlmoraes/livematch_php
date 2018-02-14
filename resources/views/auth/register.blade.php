@extends('layouts.app')

@section('nome_pagina')
    Registro de Usuário
@endsection

@section('breadcrumb')
    <li><a href="{{ route('usuarios') }}">Usuários</a></li>
    <li class="active">Registro de Usuário</li>
@endsection

@section('content')
<!-- Form horizontal -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Cadastro Usuários</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <p class="content-group-lg"> </p>

            {!! Form::open(['url' => url('/register'), 'role' => 'form', 'class' => 'form-horizontal']) !!}
            <fieldset class="content-group">
                <legend class="text-bold">Novo Usuário</legend>
                @include('common.error_form')
                    <div class="form-group">
                        {!! Form::label('empresa_id', 'Empresa', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::select('empresa_id', $empresas, null,
                                    [
                                        'class'             => 'form-control select2',
                                        'placeholder'       => 'Selecione a empresa...'
                                    ])
                            !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nome', 'Nome', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome completo']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('login', 'Login', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Login de rede']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Senha', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirmação de Senha', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'E-mail', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nivel', 'Nivel de acesso', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::select('nivel', $nivel, null,
                                    [
                                        'class'             => 'form-control select2',
                                        'placeholder'       => 'Selecione o nível de acesso...'
                                    ])
                            !!}
                        </div>
                    </div>
                </fieldset>
                <div class="text-right">
                    {!! Form::reset(null, ['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Criar Usuário', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
<!-- /form horizontal -->    
@endsection

