@extends('layouts.app')

@section('nome_pagina')
    Usuários
@endsection

@section('breadcrumb')
    <li class="active">Usuários</li>
@endsection

@section('container')
<!-- Main content -->
<!-- Basic responsive configuration -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Cadastro de usuários</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            As colunas podem ser <code>classificadas</code> clicando nos títulos.
            <a href="{{ url('/register') }}"><button type="button" class="btn btn-default pull-right"><i class="icon-user-plus position-left"></i> Add Usuário</button></a>
        </div>

        <table id="dtpadrao" class="table datatable-basic">
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
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ route('usuarios.acessos', $u->id) }}"><i class="icon-user-block"></i> Acesso</a></li>
                                    <li><a href="#"><i class="icon-trash"></i> Excluir</a></li>
                                    <li><a href="{{ route('usuarios.resetar_senha', $u->id) }}"><i class="icon-reset"></i> Resetar senha</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic responsive configuration -->
@endsection

@section('js_page')
<script src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script>
    $(function () {
        @if (count($errors) > 0)
            @foreach($errors->all() as $error)
                var msg = "{!! $error !!}";
                mensagem(msg, 'error');
            @endforeach
             $('#sweet_warning').on('click', function() {
                swal({
                    title: "Confirma a operação?",
                    text: "Após confirmação essa tarefa não poderá ser desfeita!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    confirmButtonText: "Yes, delete it!"
                });
            });
            function mensagem(msg, tipo) {
                swal({
                    title: "Oops...",
                    text: msg,
                    confirmButtonColor: "#EF5350",
                    type: tipo
                });
            }
        @endif
    });
</script>
@endsection