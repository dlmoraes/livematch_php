@extends('layouts.app')

@section('breadcrumb')
    <li><a href="{{ route('pessoas') }}">Autorização</a></li>
    <li class="active">Cadastro do Usuário</li>
@endsection

@section('nome_pagina')
    Cadastro do Usuário
@endsection


@section('container')
    <section class="content">
    <div class="row">

        {!! Form::open(['route' => ['acessos.alterarsenha.update', $usuario->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
        <div class="col-md-6">
            @include('common.error_form')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Alterar senha</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('password', 'Senha', ['class' => 'col-md-3 col-xs-12 control-label']) !!}
                        <div class="col-md-6 col-xs-12">
                            {!! Form::password('password', ['class' => 'form-control', 'required' => '', 'minLength' => '6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirmação de Senha', ['class' => 'col-md-3 col-xs-12 control-label']) !!}
                        <div class="col-md-6 col-xs-12">
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => '', 'minLength' => '6']) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! Form::reset(null, ['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Alterar Senha', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
        </section>
@endsection

