@extends('layouts.app')

@section('titulo')
    Distritais
@endsection

@section('subtitulo')
    - cadastradas
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Distritais</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar distrital" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Distrital</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Distrital</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtdistrital" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.distritais.table')
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- Horizontal form modal -->
    <div id="modaleditdistrital" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Alterar distrital</h5>
                </div>

                <form id="frmDistrital" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_distrital"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="distrital" class="control-label col-sm-3">Distrital</label>
                            <div class="col-sm-9">
                                <input id="distrital" name="distrital" type="text" placeholder="Nome da Distrital"
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
        $(function () {
            $('.btnEdit').click(function (e) {
                e.preventDefault();
                $('#modaleditdistrital .modal-title').text('Alterar distrital');
                var id = this.id;
                var name = this.name;
                $("#frmDistrital input[name=id_distrital]").val(id);
                $("#distrital").val(name);
                $('#modaleditdistrital').modal('show');
            });
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaleditdistrital .modal-title').text('Adicionar distrital');
                $("#frmDistrital input[name=id_distrital]").val('');
                $("#distrital").val('');
                $('#modaleditdistrital').modal('show');
            });
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'distritais/excluir/' + id;
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
                                }
                            })
                        }
                        else {
                            msgNotificacao('warning', 'Cancelado', "Calma, nada foi enviado.")
                        }
                    });
            });
            $('#frmDistrital').on('submit', function (e) {
                e.preventDefault();
                var distrital = $('#distrital').val();
                if (distrital.length <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos");
                    return;
                }
                var id = $("#frmDistrital input[name=id_distrital]").val();
                var token = $('input[name=_token]').val();
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'distrital': $('#distrital').val(),
                        'id': id
                    };
                    var url = 'distritais/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Distrital criada com sucesso!!!");
                                distrital = data['distrital'];
                                tblnome = $('#linha-' + id + ' td:eq(1)');
                                tblnome.text(distrital);
                                $('#linha-' + id + ' .btnEdit').attr('name', distrital);
                                $('#modaleditdistrital').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar esta operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'distritais/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'distrital': $('#distrital').val()
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Distrital criada com sucesso!!!");
                                $('#modaleditdistrital').modal('hide');
                                refreshTable();
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar esta operação");
                        }
                    })
                }

            });
        });

        function refreshTable() {
            $('tbody.table-container').fadeOut();
            $('tbody.table-container').load('distritais/lists', function () {
                $('tbody.table-container').fadeIn();
                $('.btnEdit').click(function (e) {
                    e.preventDefault();
                    $('#modaleditdistrital .modal-title').text('Alterar distrital');
                    var id = this.id;
                    var name = this.name;
                    $("#frmDistrital input[name=id_distrital]").val(id);
                    $("#distrital").val(name);
                    $('#modaleditdistrital').modal('show');
                });
                $('.btnDelete').click(function (e) {
                    e.preventDefault();
                    var id = this.name;
                    var url = 'distritais/excluir/' + id;
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
                                }
                            })
                        }
                        else {
                            msgNotificacao('warning', 'Cancelado', "Calma, nada foi enviado.")
                        }
                    });
                });
            });
        }
    </script>
@endsection