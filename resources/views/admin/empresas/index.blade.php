@extends('layouts.app')

@section('titulo')
    Empresas
@endsection

@section('subtitulo')
    - cadastradas
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Empresas</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar empresa" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Empresa</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Empresas</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtempresa" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.empresas.table')
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- Horizontal form modal -->
    <div id="modaleditempresa" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Alterar empresa</h5>
                </div>

                <form id="frmEmpresa" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_empresa"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="empresa" class="control-label col-sm-3">Empresa</label>
                            <div class="col-sm-9">
                                <input id="empresa" name="empresa" type="text" placeholder="Nome da Empresa"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /horizontal form modal -->
@endsection

@section('scripts')
    <script>
        btnEditClick = function () {
            $('.btnEdit').click(function (e) {
                e.preventDefault();
                $('#modaleditempresa .modal-title').text('Alterar empresa');
                var id = this.id;
                var name = this.name;
                $("#frmEmpresa input[name=id_empresa]").val(id);
                $("#empresa").val(name);
                $('#modaleditempresa').modal('show');
            });
        }
        btnDeleteClick = function () {
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'empresas/excluir/' + id;
                var token = $('input[name=_token]').val();
                // Alert combination
                swal({
                        title: "Confirmação de Exclusão",
                        text: "Você tem certeza que deseja prosseguir com a exclusão?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Sim, pode excluir!",
                        cancelButtonText: "Não, cliquei sem querer!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    '_token': token,
                                    'id': id
                                },
                                success: function (data) {
                                    msgNotificacao("success", "Alterações salvas!", "O registro foi excluido!!!");
                                },
                                error: function (error) {
                                    msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar está operação");
                                },
                                complete: function () {
                                    console.log('Chamou')
                                    $('#linha-' + id).addClass("animated fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                                        console.log('Chegou acima do remove');
                                        $('#linha-' + id).remove();
                                    });
                                }
                            })
                        }
                        else {
                            msgNotificacao('warning', 'Cancelado', "Calma, nada foi enviado.")
                        }
                    });
            });
        }

        $(function () {
            btnEditClick();
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaleditempresa .modal-title').text('Adicionar empresa');
                $("#frmEmpresa input[name=id_empresa]").val('');
                $("#empresa").val('');
                $('#modaleditempresa').modal('show');
            });
            btnDeleteClick();
            $('#frmEmpresa').on('submit', function (e) {
                e.preventDefault();
                var empresa = $('#empresa').val();
                if (empresa.length <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos");
                    return;
                }
                var id = $("#frmEmpresa input[name=id_empresa]").val();
                var token = $('input[name=_token]').val();
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'empresa': $('#empresa').val(),
                        'id': id
                    };
                    var url = 'empresas/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Feedback gerado com sucesso!!!");
                                empresa = data['empresa'];
                                tblnome = $('#linha-' + id + ' td:eq(1)');
                                tblnome.text(empresa);
                                $('#linha-' + id + ' .btnEdit').attr('name', empresa);
                                $('#modaleditempresa').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar está operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'empresas/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'empresa': $('#empresa').val()
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Feedback gerado com sucesso!!!");
                                $('#modaleditempresa').modal('hide');
                                refreshTable();
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar está operação");
                        }
                    })
                }

            });
        });

        function refreshTable() {
            $('tbody.table-container').fadeOut();
            $('tbody.table-container').load('empresas/lists', function () {
                $('tbody.table-container').fadeIn();
                btnEditClick();
                btnDeleteClick();
            });
        }
    </script>
@endsection