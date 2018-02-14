@extends('layouts.app')

@section('nome_pagina')
    Cadastro Acessos
@endsection

@section('breadcrumb')
    <li><a href="{{ route('usuarios') }}">Usuários</a></li>
    <li class="active">Acesso de Usuário</li>
@endsection

@section('content')
<!-- Form horizontal -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Acesso Usuário</h5>
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

            {!! Form::open(['route' => ['usuarios.acessos.update', $usuario->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                <fieldset class="content-group">
                    <legend class="text-bold">Acesso</legend>
                    @include('common.error_form')
                    <div class="form-group">
                        {!! Form::label('nivel', 'Nível do usuário', ['class' => 'control-label col-lg-2']) !!}
                        <div class="col-lg-10">
                            {!! Form::select('nivel', $usuario->getNiveis(), $usuario->getChaveNiveis(), ['class' => 'form-control',
                                    'placeholder'       => 'Selecione nivel...'

                                   ]) 
                            !!}
                        </div>
                    </div>
                </fieldset>    
                <div class="text-right">
                    {!! Form::reset(null, ['class' => 'btn btn-default']) !!}
                    {!! Form::submit('Atualizar acessos', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}

        </div>
    </div>
<!-- /form horizontal -->
@endsection

