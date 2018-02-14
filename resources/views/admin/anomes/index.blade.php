@extends('layouts.app')

@section('titulo')
    Calendário
@endsection

@section('subtitulo')
    - Ano e Mês
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Ano e Mês</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar calendário" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Calendário</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Calendário</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtanomes" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ano</th>
                    <th>Meses</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.anomes.table')
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- Horizontal form modal -->
    <div id="modaledit" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Alterar calendário</h5>
                </div>

                @include('admin.anomes.form')
            </div>
        </div>
    </div>
    <!-- /horizontal form modal -->
@endsection

@section('scripts')
    <script>
        btnEditClick = function (id) {
            $('.btnEdit').click(function (e) {
                e.preventDefault();
                $('#modaledit .modal-title').text('Alterar calendário');
                var id = this.id;
                // var linha = $('#linha-' + id);
                $("#frmAnoMes input[name=id_anomes]").val(id);
                $("#ano_id").select2('val', ($('#linha-' + id + ' td:eq(1)').attr('name')));
                $("#mes_id").select2('val', ($('#linha-' + id + ' td:eq(2)').attr('name')));
                $('#modaledit').modal('show');
            });
        }
        btnDeleteClick = function () {
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'anomes/excluir/' + id;
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

        function limparFormIndicator() {
            $("#frmAnoMes input[name=id_anomes]").val();
            $("#ano_id").select2('val', 0);
            $("#mes_id").select2('val', 0);
            $('#modaledit').modal('show');
        }

        $(function () {
            btnEditClick();
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaledit .modal-title').text('Adicionar calendário');
                $("#frmAnoMes input[name=id_anomes]").val('');
                $("#ano_id").select2('val', '0');
                $("#mes_id").select2('val', '0');
                $('#modaledit').modal('show');
            });
            btnDeleteClick();
            $('#frmAnoMes').on('submit', function (e) {
                e.preventDefault();
                var token = $('input[name=_token]').val();
                var id = $("#frmAnoMes input[name=id_anomes]").val();
                var ano = $("#ano_id").val();
                var txtAno = $('#ano_id').select2('data')[0].text;
                var mes = $("#mes_id").val();
                var txtMes = $('#mes_id').select2('data')[0].text;
                if (ano <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe um ano válido...");
                    return;
                }
                if (mes <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe um mês válido...");
                    return;
                }
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'ano_id': ano,
                        'mes_id': mes,
                        'id': id
                    };
                    var url = 'anomes/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Operação realizada com sucesso!!!");
                                $('#linha-' + id + ' td:eq(1)').text(txtAno);
                                $('#linha-' + id + ' td:eq(2)').attr('name', data['ano_id']);
                                $('#linha-' + id + ' td:eq(3)').text(txtMes);
                                $('#linha-' + id + ' td:eq(4)').attr('name', data['mes_id']);
                                limparFormIndicator();
                                $('#modaledit').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar está operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'anomes/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'ano_id': ano,
                            'mes_id': mes
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Operação realizada com sucesso!!!");
                                $('#modaledit').modal('hide');
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
            $('tbody.table-container').load('anomes/lists', function () {
                $('tbody.table-container').fadeIn();
                btnEditClick();
                btnDeleteClick();
            });
        }
    </script>
@endsection
