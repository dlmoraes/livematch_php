@extends('layouts.app')

@section('titulo')
    Regionais
@endsection

@section('subtitulo')
    - cadastradas
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Regionais</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar regional" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Regional</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Regional</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtregional" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.regionais.table')
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- Horizontal form modal -->
    <div id="modaleditregional" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Alterar regional</h5>
                </div>

                <form id="frmRegional" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_regional"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="regional" class="control-label col-sm-3">Regional</label>
                            <div class="col-sm-9">
                                <input id="regional" name="regional" type="text" placeholder="Nome da Regional"
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
                $('#modaleditregional .modal-title').text('Alterar regional');
                var id = this.id;
                var name = this.name;
                $("#frmRegional input[name=id_regional]").val(id);
                $("#regional").val(name);
                $('#modaleditregional').modal('show');
            });
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaleditregional .modal-title').text('Adicionar regional');
                $("#frmRegional input[name=id_regional]").val('');
                $("#regional").val('');
                $('#modaleditregional').modal('show');
            });
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'regionais/excluir/' + id;
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
            $('#frmRegional').on('submit', function (e) {
                e.preventDefault();
                var regional = $('#regional').val();
                if (regional.length <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos");
                    return;
                }
                var id = $("#frmRegional input[name=id_regional]").val();
                var token = $('input[name=_token]').val();
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'regional': $('#regional').val(),
                        'id': id
                    };
                    var url = 'regionais/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Regional criada com sucesso!!!");
                                regional = data['regional'];
                                tblnome = $('#linha-' + id + ' td:eq(1)');
                                tblnome.text(regional);
                                $('#linha-' + id + ' .btnEdit').attr('name', regional);
                                $('#modaleditregional').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar esta operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'regionais/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'regional': $('#regional').val()
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Regional criada com sucesso!!!");
                                $('#modaleditregional').modal('hide');
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
            $('tbody.table-container').load('regionais/lists', function () {
                $('tbody.table-container').fadeIn();
                $('.btnEdit').click(function (e) {
                    e.preventDefault();
                    $('#modaleditregional .modal-title').text('Alterar regional');
                    var id = this.id;
                    var name = this.name;
                    $("#frmRegional input[name=id_regional]").val(id);
                    $("#regional").val(name);
                    $('#modaleditregional').modal('show');
                });
                $('.btnDelete').click(function (e) {
                    e.preventDefault();
                    var id = this.name;
                    var url = 'regionais/excluir/' + id;
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