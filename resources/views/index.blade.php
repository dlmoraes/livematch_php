@extends('layouts.app')

@section('titulo')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('container')
    {{ csrf_field() }}
    <!-- Content area -->
    <div class="content">
        <!-- Detached content -->
        <div class="container-detached">
            <div class="content-detached">
                <!-- Tasks options -->
                <form class="form-horizontal">
                    <div class="row">
                        <div class="navbar navbar-default navbar-xs navbar-component">
                            <ul class="nav navbar-nav no-border visible-xs-block">
                                <li><a class="text-center collapsed" data-toggle="collapse"
                                       data-target="#navbar-filter"><i
                                                class="icon-menu7"></i></a></li>
                            </ul>
                            <div class="navbar-collapse collapse" id="navbar-filter">
                                <p class="navbar-text text-bold">Filtro:</p>
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-color-sampler position-left"></i> Por Tipo <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-tipos">
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-sort-numeric-asc position-left"></i> Por prioridade
                                            <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-prioridades">
                                            <li class="active"><a href="#" name="-1">Mostrar todos</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" name="0">Máxima</a></li>
                                            <li><a href="#" name="1">Alta</a></li>
                                            <li><a href="#" name="2">Normal</a></li>
                                            <li><a href="#" name="3">Baixa</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-stack3 position-left"></i> Por categoria
                                            <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-categorias">
                                        </ul>
                                    </li>
                                </ul>
                                <p class="navbar-text text-bold">Classificar:</p>
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-sort-time-asc position-left"></i> Por data
                                            atualização
                                            <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-class-atul">
                                            <li><a href="#">Recentes</a></li>
                                            <li><a href="#">Antigos</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /tasks options -->
                    </div>
                </form>

                <!-- Tasks grid -->
                <div class="text-center content-group text-muted content-divider">
                    <span class="pt-10 pb-10">Indicadores</span>
                </div>
                <div class="row">
                    <div id="grade"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var dtIndicadores;
        var dtCategorias;
        var dtTipos;
        var filtros = [];
        var clickCategorias = function () {
            $('.dropdown-categorias li a').on('click', function (e) {
                e.preventDefault();
                var filtro = this.name;
                if (filtro < 0) {
                    $.each(filtros, function (index, value) {
                        if (value.alvo == 'categoria') {
                            filtros.splice(index, 1);
                        }
                    });
                } else {
                    var resultado = false;
                    $.each(filtros, function (index, value) {
                        if (value.alvo == 'categoria') {
                            filtros[index]['filtro'] = filtro;
                            resultado = true;
                        }
                    });
                    if (!resultado) {
                        filtros.push({
                            alvo: 'categoria',
                            filtro: filtro
                        });
                    }
                }
                $('.dropdown-categorias li').removeClass('active');
                $(this).parent('li').addClass('active');
                filtrarGrade(filtros);
            });
        }
        var clickTipos = function () {
            $('.dropdown-tipos li a').on('click', function (e) {
                e.preventDefault();
                var filtro = this.name;
                if (filtro < 0) {
                    $.each(filtros, function (index, value) {
                        if (value.alvo == 'tipo') {
                            filtros.splice(index, 1);
                        }
                    });
                } else {
                    var resultado = false;
                    $.each(filtros, function (index, value) {
                        if (value.alvo == 'tipo') {
                            filtros[index]['filtro'] = filtro;
                            resultado = true;
                        }
                    });
                    if (!resultado) {
                        filtros.push({
                            alvo: 'tipo',
                            filtro: filtro
                        });
                    }
                }
                $('.dropdown-tipos li').removeClass('active');
                $(this).parent('li').addClass('active');
                filtrarGrade(filtros);
            });
        }
        var clickPrioridades = function () {
            $('.dropdown-prioridades li a').on('click', function (e) {
                e.preventDefault();
                var filtro = this.name;
                if (filtro < 0) {
                    $.each(filtros, function (index, value) {
                        if (value.alvo == 'prioridade') {
                            filtros.splice(index, 1);
                        }
                    });
                } else {
                    filtro = converterOrdemEmPrioridade(this.name);
                    var resultado = false;
                    $.each(filtros, function (index, value) {
                        if (value.alvo == 'prioridade') {
                            filtros[index]['filtro'] = filtro;
                            resultado = true;
                        }
                    });
                    if (!resultado) {
                        filtros.push({
                            alvo: 'prioridade',
                            filtro: converterOrdemEmPrioridade(this.name)
                        });
                    }
                }
                $('.dropdown-prioridades li').removeClass('active');
                $(this).parent('li').addClass('active');
                filtrarGrade(filtros);
            });
        }
        var clickClassificar = function () {
            $('.dropdown-class-atul li a').on('click', function (e) {
                e.preventDefault();
                classificarGrade();
            })
        }
        $(function () {
            var token = $('input[name=_token]').val();

            function carregarIndicadores() {
                $.ajax({
                    url: 'common/indicadores',
                    type: 'GET',
                    data: {
                        '_token': token
                    },
                    success: function (data) {
                        dtIndicadores = data;
                        construirGrid(dtIndicadores);
                    },
                    error: function (error) {
                        console.log('Error', error);
                    }
                });
            }

            function carregarCategorias() {
                $.ajax({
                    url: 'common/categorias',
                    type: 'GET',
                    data: {
                        '_token': token
                    },
                    success: function (data) {
                        dtCategorias = data;
                        popularFiltroCategoria(dtCategorias);
                    },
                    error: function (error) {
                        console.log('Error', error);
                    }
                });
            }

            function carregarTipos() {
                $.ajax({
                    url: 'common/tipos',
                    type: 'GET',
                    data: {
                        '_token': token
                    },
                    success: function (data) {
                        dtTipos = data;
                        popularFiltroTipo(dtTipos);
                    },
                    error: function (error) {
                        console.log('Error', error);
                    }
                });
            }

            carregarCategorias();
            carregarTipos();
            carregarIndicadores();
            clickCategorias();
            clickTipos();
            clickPrioridades();
            clickClassificar();
        });

        function construirGrid(dtIndicadores) {
            var template = gridIndicadorTemplate;
            $.each(dtIndicadores, function (index, value) {
                template = template.replace('#urlIndicador', 'common/indicador/' + value['id']);
                template = template.replace('#tituloIndicador', value['indicador']);
                template = template.replace('#idcategoria', value['categoria_id']);
                template = template.replace('#idtipo', value['tipo_ind_id']);
                template = template.replace('#objetivoIndicador', value['objetivo']);
                template = template.replace('#dtmodificado', value['updated_at']);
                template = template.replace('#corPrioridade', colorOrdem(value['ordem']));
                template = template.replace('#txtPrioridade', converterOrdemEmPrioridade(value['ordem']));
                template = template.replace(new RegExp('#txtPrioridade'), converterOrdemEmPrioridade(value['ordem']));
                template = template.replace('#txtCategoria', getCategoria(value['categoria_id']));
                template = template.replace('#iconTipo', converterTipoIndicadorEmIcone(value['tipo_ind_id']));
                $('#grade').append(template);
                template = gridIndicadorTemplate;
            });
        }

        function colorOrdem(ordem) {
            var retorno = ''
            switch (ordem) {
                case '0':
                    retorno = 'label-danger';
                    break;
                case '1':
                    retorno = 'label-info';
                    break;
                case '2':
                    retorno = 'label-primary';
                    break;
                case '3':
                    retorno = 'label-success';
                    break;
            }
            return retorno;
        }

        function converterOrdemEmPrioridade(ordem) {
            var retorno = ''
            switch (ordem) {
                case '0':
                    retorno = 'Máxima';
                    break;
                case '1':
                    retorno = 'Alta';
                    break;
                case '2':
                    retorno = 'Normal';
                    break;
                case '3':
                    retorno = 'Baixa';
                    break;
            }
            return retorno;
        }

        function converterTipoIndicadorEmIcone(tipo) {
            //console.log(tipo)
            var retorno = ''
            switch (tipo) {
                case '1':
                    retorno = 'icon-chess-king';
                    break;
                case '2':
                    retorno = 'icon-chess';
                    break;
            }
            return retorno;
        }

        function getCategoria(categoria_id) {
            return dtCategorias[categoria_id];
        }

        function popularFiltroCategoria(dtCategorias) {
            $('.dropdown-categorias').append('<li class="active"><a href="#" name="-1">Mostrar todas</a></li>');
            $('.dropdown-categorias').append('<li class="divider"></li>');
            $.each(dtCategorias, function (index, value) {
                $('.dropdown-categorias').append(
                    '<li><a href="#" name="' + index + '">' + value + '</a></li>'
                );
            });
            clickCategorias();
        }

        function popularFiltroTipo(dtTipos) {
            $('.dropdown-tipos').append('<li class="active"><a href="#" name="-1">Mostrar todos</a></li>');
            $('.dropdown-tipos').append('<li class="divider"></li>');
            $.each(dtTipos, function (index, value) {
                $('.dropdown-tipos').append(
                    '<li><a href="#" name="' + index + '">' + value + '</a></li>'
                );
            });
            clickTipos();
        }

        function filtrarGrade(filtros) {
            // $(".grade").addClass("animated zoomInUp").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            //     $(this).removeClass('animated zoomInUp').show();
            // });
            $(".grade").show(function (e) {
                // $(this).addClass("animated fadeInUp").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                //     $(this).removeClass('animated fadeInUp');
                // });
            });
            setTimeout(function () {
                if (filtros.length > 0) {
                    $.each(filtros, function (index, value) {
                        $('input[name=' + value.alvo + ']').filter(function (index) {
                            if ($(this).val() != value.filtro) {
                                $(this).parent(".grade").addClass("animated fadeOutUp").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                                    $(this).removeClass('animated fadeOutUp').hide();
                                });
                                // $(this).parent().hide();
                            }
                        });
                    });
                }
            }, 800);
        }

        function classificarGrade() {
            // var grade = $('#grade');
            // var grades = grade.children('.grade').detach().get();
            // grades.sort(function(a, b) {
            //     // console.log($(a).val());
            //     // console.log(new Date($(a).data('date')));
            //     return new Date($(a).data('date')) - new Date($(b).data('date'));
            // });
            // grade.append(grades);
            // $('.grade').sort(sort_grade).appendTo('.grade');
        }


    </script>
@endsection
