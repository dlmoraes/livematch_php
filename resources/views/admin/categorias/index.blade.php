@extends('layouts.app')

@section('titulo')
    Categorias
@endsection

@section('subtitulo')
    - cadastradas
@endsection

@section('breadcrumb')
    <li>Administração</li>
    <li class="active">Categorias</li>
@endsection

@section('botoes_extras')
    <a id="btnAdd" data-popup="tooltip" title="Adicionar categoria" class="btn btn-primary btn-labeled"><b><i
                    class="icon-plus-circle2"></i></b> Categoria</a>
@endsection

@section('container')

    <!-- Content area -->
    <div class="content">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Categoria</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload" onclick="refreshTable();"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <table id="dtcategoria" class="table dtpadrao table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody class="table-container">
                @include('admin.categorias.table')
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- Horizontal form modal -->
    <div id="modaleditcategoria" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Alterar categoria</h5>
                </div>

                <form id="frmCategoria" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_categoria"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoria" class="control-label col-sm-3">Categoria</label>
                            <div class="col-sm-9">
                                <input id="categoria" name="categoria" type="text" placeholder="Nome da Categoria"
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
                $('#modaleditcategoria .modal-title').text('Alterar categoria');
                var id = this.id;
                var name = this.name;
                $("#frmCategoria input[name=id_categoria]").val(id);
                $("#categoria").val(name);
                $('#modaleditcategoria').modal('show');
            });
            $('#btnAdd').click(function (e) {
                e.preventDefault();
                $('#modaleditcategoria .modal-title').text('Adicionar categoria');
                $("#frmCategoria input[name=id_categoria]").val('');
                $("#categoria").val('');
                $('#modaleditcategoria').modal('show');
            });
            $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'categorias/excluir/' + id;
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
            $('#frmCategoria').on('submit', function (e) {
                e.preventDefault();
                var categoria = $('#categoria').val();
                if (categoria.length <= 0) {
                    msgNotificacao("warning", "Oops...", "Dados inválidos");
                    return;
                }
                var id = $("#frmCategoria input[name=id_categoria]").val();
                var token = $('input[name=_token]').val();
                if (id > 0) {
                    var form = {
                        '_token': token,
                        'categoria': $('#categoria').val(),
                        'id': id
                    };
                    var url = 'categorias/edit/' + id;
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: form,
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Categoria criada com sucesso!!!");
                                categoria = data['categoria'];
                                tblnome = $('#linha-' + id + ' td:eq(1)');
                                tblnome.text(categoria);
                                $('#linha-' + id + ' .btnEdit').attr('name', categoria);
                                $('#modaleditcategoria').modal('hide');
                            }
                        },
                        error: function (error) {
                            msgNotificacao("error", "Oops...", "Ocorreu um erro ao realizar esta operação");
                        }
                    })
                } else {
                    $.ajax({
                        url: 'categorias/adicionar',
                        type: 'POST',
                        data: {
                            '_token': token,
                            'categoria': $('#categoria').val()
                        },
                        success: function (data) {
                            if ((data.errors)) {
                                msgNotificacao("error", "Oops...", 'Dados inválidos!');
                            } else {
                                msgNotificacao("success", "Alterações salvas!", "Categoria criada com sucesso!!!");
                                $('#modaleditcategoria').modal('hide');
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
            $('tbody.table-container').load('categorias/lists', function () {
                $('tbody.table-container').fadeIn();
                $('.btnEdit').click(function (e) {
                    e.preventDefault();
                    $('#modaleditcategoria .modal-title').text('Alterar categoria');
                    var id = this.id;
                    var name = this.name;
                    $("#frmCategoria input[name=id_categoria]").val(id);
                    $("#categoria").val(name);
                    $('#modaleditcategoria').modal('show');
                });
                $('.btnDelete').click(function (e) {
                e.preventDefault();
                var id = this.name;
                var url = 'categorias/excluir/' + id;
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
        };
    </script>
@endsection