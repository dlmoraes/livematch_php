@extends('layouts.app')

@section('titulo')
    Usuários
@endsection

@section('subtitulo')
    - cadastrados
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Usuários</li>
@endsection

@section('botoes_extras')
    <a href="#" class="btn btn-link btn-float has-text"><i
                class="icon-user-plus text-primary"></i><span>Add Usuário</span></a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Usuários</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            {{--<div class="panel-body">--}}
            <table id="dtusuarios" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Login</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nivel</th>
                    <th>Empresa</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->login }}</td>
                        <td>{{ $u->nome }}</td>
                        <td><a href="mailto:{{ $u->email }}">{{ $u->email }}</a></td>
                        <td>{{ $u->nivel }}</td>
                        <td>{{ $u->getEmpresa() }}</td>
                        <td class="text-center">
                            <div class="btn-group" data-toggle="buttons">
                                <a class="btn bg-grey-700 btn-xs" href="{{ route('usuarios.acessos', $u->id) }}" data-popup="tooltip" title="Acesso"><i
                                            class="icon-user-block"></i> </a>
                                <a class="btn bg-grey-700 btn-xs" href="{{ route('usuarios.resetar_senha', $u->id) }}" data-popup="tooltip"
                                   title="Resetar Senha"><i class="icon-reset"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
        {{--</div>--}}
    </div>
@endsection

@section('scripts')
@endsection