@extends('layouts.app')

@section('breadcrumb')
    <li><a href="{{ route('usuarios') }}">Usuarios</a></li>
    <li>Cadastro do Usuário</li>
    <li class="active">Resetar senha</li>
@endsection

@section('nome_pagina')
    Resetar senha
@endsection

@section('container')
    <section class="content">
    <div class="row">
        {!! Form::open(['route' => ['usuarios.resetando_senha', $usuario->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
        <div class="col-md-6">
            @include('common.error_form')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Resetar senha</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>
                        Você tem certeza que deseja, <strong>forçar a alteração de senha do usuário {{ $usuario->login }}</strong>, para a senha padrão?
                    </p>
                </div>
                <div class="box-footer">
                    {!! Form::submit('Resetar Senha', ['class' => 'btn btn-flat btn-primary pull-right']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
        </section>
@endsection

