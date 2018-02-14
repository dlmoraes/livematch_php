@extends('layouts.app')

@section('titulo')
    Indicadores
@endsection

@section('subtitulo')
    - cadastrados
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Indicadores</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar indicador" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Indicador</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Indicadores</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtindicador" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ord.</th>
                    <th>Categoria</th>
                    <th>Tipo</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.indicadores.table')
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
                    <h5 class="modal-title">Alterar indicador</h5>
                </div>

                @include('admin.indicadores.form')
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
                $('#modaledit .modal-title').text('Alterar indicador');
                var id = this.id;
                // var linha = $('#linha-' + id);
                $("#frmIndicador input[name=id_indicador]").val(id);
                $("#indicador").val($('#linha-' + id + ' td:eq(1)').text());
                $("#categoria_id").select2('val', ($('#linha-' + id + ' td:eq(3)').attr('name')));
                $("#tipo_ind_id").select2('val', ($('#linha-' + id + ' td:eq(4)').attr('name')));
                $("#ordem").val($('#linha-' + id + ' td:eq(2)').text());
                $('#modaledit').modal('show');
            });
        }
        btnDeleteClick = function () {
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'indicadores/excluir/' + id;
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
          $("#frmIndicador input[name=id_indicador]").val();
          $("#indicador").val('');
          $("#objetivo").val('');
          $("#categoria_id").select2('val', 0);
          $("#tipo_ind_id").select2('val', 0);
          $("#ordem").val(0);
          $('#modaledit').modal('show');
        }
        $(function () {
            btnEditClick();
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaledit .modal-title').text('Adicionar indicador');
                limparFormIndicator();
                /*$("#frmIndicador input[name=id_indicador]").val('');
                $("#indicador").val('');
                $("#objetivo").val('');
                $("#categoria_id").select2('val', '0');
                $("#tipo_ind_id").select2('val', '0');
                $("#ordem").val(0);*/
                $('#modaledit').modal('show');
            });
            btnDeleteClick();
            $('#frmIndicador').on('submit', function (e) {
                e.preventDefault();
                var token = $('input[name=_token]').val();
                var id = $("#frmIndicador input[name=id_indicador]").val();
                var indicador = $('#indicador').val();
                var categoria = $("#categoria_id").val();
                var txtCategoria = $('#categoria_id').select2('data')[0].text;
                var tipo = $("#tipo_ind_id").val();
                var txtTipo = $('#tipo_ind_id').select2('data')[0].text;
                var ordem = $("#ordem").val();
                var objetivo =  $('#objetivo').val();
                if (indicador.length <= 0 || indicador == "") {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Erro no indicador informado...");
                    return;
                }
                if (categoria <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe uma categoria válida...");
                    return;
                }
                if (tipo <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe um tipo de indicador válido...");
                    return;
                }
                if (ordem < 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos<br/>Informe uma ordem positiva ou 0 (zero)...");
                    return;
                }
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'indicador': indicador,
                        'categoria_id': categoria,
                        'tipo_ind_id': tipo,
                        'ordem': ordem,
                        'objetivo': objetivo,
                        'id': id
                    };
                    var url = 'indicadores/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Feedback gerado com sucesso!!!");
                                $('#linha-' + id + ' td:eq(1)').text(data['indicador']);
                                $('#linha-' + id + ' td:eq(2)').text(data['ordem']);
                                $('#linha-' + id + ' td:eq(3)').text(txtCategoria);
                                $('#linha-' + id + ' td:eq(3)').attr('name', data['categoria_id']);
                                $('#linha-' + id + ' td:eq(4)').text(txtTipo);
                                $('#linha-' + id + ' td:eq(4)').attr('name', data['tipo_ind_id']);
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
                        url: 'indicadores/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'indicador': indicador,
                            'categoria_id': categoria,
                            'tipo_ind_id': tipo,
                            'objetivo': objetivo,
                            'ordem': ordem
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Feedback gerado com sucesso!!!");
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
            $('tbody.table-container').load('indicadores/lists', function () {
                $('tbody.table-container').fadeIn();
                btnEditClick();
                btnDeleteClick();
            });
        }
    </script>
@endsection
