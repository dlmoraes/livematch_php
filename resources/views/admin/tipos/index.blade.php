@extends('layouts.app')

@section('titulo')
    Tipos de Indicadores
@endsection

@section('subtitulo')
    - cadastrados
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Tipos de Indicador</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar tipo" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Tipo</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Tipos de Indicador</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dttipo" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.tipos.table')
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- Horizontal form modal -->
    <div id="modaledittipo" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Alterar tipo</h5>
                </div>

                <form id="frmTipo" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_tipo"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tipo" class="control-label col-sm-3">Tipo</label>
                            <div class="col-sm-9">
                                <input id="tipo" name="tipo" type="text" placeholder="Nome do Tipo"
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
                $('#modaledittipo .modal-title').text('Alterar tipo');
                var id = this.id;
                var name = this.name;
                $("#frmTipo input[name=id_tipo]").val(id);
                $("#tipo").val(name);
                $('#modaledittipo').modal('show');
            });
        }
        btnDeleteClick = function () {
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'tipos/excluir/' + id;
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
                                    $('#linha-' + id).addClass("animated fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
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
                $('#modaledittipo .modal-title').text('Adicionar tipo');
                $("#frmTipo input[name=id_tipo]").val('');
                $("#tipo").val('');
                $('#modaledittipo').modal('show');
            });
            btnDeleteClick();
            $('#frmTipo').on('submit', function (e) {
                e.preventDefault();
                var tipo = $('#tipo').val();
                if (tipo.length <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos");
                    return;
                }
                var id = $("#frmTipo input[name=id_tipo]").val();
                var token = $('input[name=_token]').val();
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'tipo': $('#tipo').val(),
                        'id': id
                    };
                    var url = 'tipos/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Feedback gerado com sucesso!!!");
                                tipo = data['tipo'];
                                tblnome = $('#linha-' + id + ' td:eq(1)');
                                tblnome.text(tipo);
                                $('#linha-' + id + ' .btnEdit').attr('name', tipo);
                                $('#modaledittipo').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar está operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'tipos/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'tipo': $('#tipo').val()
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Feedback gerado com sucesso!!!");
                                $('#modaledittipo').modal('hide');
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
            $('tbody.table-container').load('tipos/lists', function () {
                $('tbody.table-container').fadeIn();
                btnEditClick();
                btnDeleteClick();
            });
        }
    </script>
@endsection