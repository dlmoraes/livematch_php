@extends('layouts.app')

@section('titulo')
    Metas
@endsection

@section('subtitulo')
    - cadastradas
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Metas</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar meta" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Meta</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Metas</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtmeta" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Indicador</th>
                    <th>Empresa</th>
                    <th>Regional</th>
                    <th>Distrital</th>
                    <th>Unidade</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.metas.table')
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
                    <h5 class="modal-title">Alterar meta</h5>
                </div>

                @include('admin.metas.form')
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
                $('#modaledit .modal-title').text('Alterar meta');
                var id = this.id;
                // var linha = $('#linha-' + id);
                $("#frmMeta input[name=id_meta]").val(id);
                console.log($('#linha-' + id + ' td:eq(3)').attr('name') == '');
                $("#indicador_id").select2('val', ($('#linha-' + id + ' td:eq(1)').attr('name')));
                $("#empresa_id").select2('val', ($('#linha-' + id + ' td:eq(2)').attr('name')));
                $("#regional_id").select2('val',
                    $('#linha-' + id + ' td:eq(3)').attr('name') == '' ? 0 : $('#linha-' + id + ' td:eq(3)').attr('name')
                );
                $("#distrital_id").select2('val',
                    $('#linha-' + id + ' td:eq(4)').attr('name') == '' ? 0 : $('#linha-' + id + ' td:eq(4)').attr('name')
                );
                $("#unidade").select2('val', ($('#linha-' + id + ' td:eq(5)').attr('name')));
                $('#modaledit').modal('show');
            });
        }
        btnDeleteClick = function () {
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'metas/excluir/' + id;
                var token = $('input[name=_token]').val();
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
        function limparFormMeta() {
          $("#frmMeta input[name=id_meta]").val();
            $("#indicador_id").select2('val', 0);
            $("#empresa_id").select2('val', 0);
            $("#regional_id").select2('val', 0);
            $("#distrital_id").select2('val', 0);
            $("#unidade").select2('val', 0);
        }
        $(function () {
            btnEditClick();
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaledit .modal-title').text('Adicionar meta');
                limparFormMeta();
                $('#modaledit').modal('show');
            });
            btnDeleteClick();
            $('#frmMeta').on('submit', function (e) {
                e.preventDefault();
                var token = $('input[name=_token]').val();
                var id = $("#frmMeta input[name=id_meta]").val();
                var indicador = $("#indicador_id").val();
                var txtIndicador = $('#indicador_id').select2('data')[0].text;
                var empresa = $("#empresa_id").val();
                var txtEmpresa = $('#empresa_id').select2('data')[0].text;
                var regional = $("#regional_id").val();
                var txtRegional = $('#regional_id').select2('data')[0].text;
                var distrital = $("#distrital_id").val();
                var txtDistrital = $('#distrital_id').select2('data')[0].text;
                var unidade = $("#unidade").val();
                var txtUnidade = $('#unidade').select2('data')[0].text;
                if (indicador <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe um indicador válido...");
                    return;
                }
                if (empresa <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe uma empresa válida...");
                    return;
                }
                if (unidade <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe uma unidade válida...");
                    return;
                }
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'indicador_id': indicador,
                        'empresa_id': empresa,
                        'regional_id': regional,
                        'distrital_id': distrital,
                        'unidade': unidade,
                        'id': id
                    };
                    var url = 'metas/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Meta gerada com sucesso!!!");
                                $('#linha-' + id + ' td:eq(1)').text(txtIndicador);
                                $('#linha-' + id + ' td:eq(1)').attr('name', data['indicador_id']);
                                $('#linha-' + id + ' td:eq(2)').text(txtEmpresa);
                                $('#linha-' + id + ' td:eq(2)').attr('name', data['empresa_id']);
                                $('#linha-' + id + ' td:eq(3)').text(txtRegional);
                                $('#linha-' + id + ' td:eq(3)').attr('name', data['regional_id']);
                                $('#linha-' + id + ' td:eq(4)').text(txtDistrital);
                                $('#linha-' + id + ' td:eq(4)').attr('name', data['distrital_id']);
                                $('#linha-' + id + ' td:eq(5)').text(txtUnidade);
                                $('#linha-' + id + ' td:eq(5)').attr('name', data['unidade']);
                                limparFormMeta();
                                $('#modaledit').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar está operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'metas/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'indicador_id': indicador,
                            'empresa_id': empresa,
                            'regional_id': regional,
                            'distrital_id': distrital,
                            'unidade': unidade
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Meta gerada com sucesso!!!");
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
            $('tbody.table-container').load('metas/lists', function () {
                $('tbody.table-container').fadeIn();
                btnEditClick();
                btnDeleteClick();
            });
        }
    </script>
@endsection
