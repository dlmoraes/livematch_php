var gridIndicadorTemplate = "<div class='col-md-4 grade' data-date='#dtmodificado'> " +
    "    <input type='hidden' name='categoria' value='#idcategoria' /> " +
    "    <input type='hidden' name='tipo' value='#idtipo' /> " +
    "    <input type='hidden' name='prioridade' value='#txtPrioridade' /> " +
//    "    <input type='hidden' name='dtmodificado' value='' /> " +
    "    <div class='panel border-left-lg border-left-primary'> " +
    "        <div class='panel-body'> " +
    "            <div class='row'> " +
    "                <div class='col-md-8'> " +
    "                    <h6 class='no-margin-top'><a href='#urlIndicador'>#tituloIndicador</a></h6> " +
    "                    <p class='mb-15'>#objetivoIndicador</p> " +
    "                </div> " +
    "                <div class='col-md-4'> " +
    "                 <ul class='list task-details'> " +
    "                    <li><span class='label #corPrioridade'> #txtPrioridade</span></li> " +
    "                    <li><span class='label bg-slate label-rounded label-icon'><i class='#iconTipo'></i></span></li> " +
    "                  </ul> " +
    "                </div>  " +
    "            </div> " +
    "        </div> " +
    "        <div class='panel-footer panel-footer-condensed'> " +
    "        	<div class='heading-elements'> " +
    "        		<span class='heading-text'>Categoria: <span class='text-semibold'>#txtCategoria</span></span> " +
    "        	</div> " +
    "        </div> " +
    "    </div> " +
    "</div>";
var dtpadrao = function () {
    $.extend($.fn.dataTable.defaults, {
        autoWidth: true,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: {'first': 'Primeiro', 'last': 'Último', 'next': '&rarr;', 'previous': '&larr;'},
            sInfo: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            sInfoEmpty: "Mostrando 0 to 0 of 0 registros"
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $('.dtpadrao').DataTable({
        allowClear: true,
        fixedHeader: true,
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn bg-grey-600 btn-icon',
                text: '<i class="icon-copy3" data-popup="tooltip" title="Copiar linhas da tabela" data-placement="top"></i>'
            },
            {
                extend: 'excelHtml5',
                className: 'btn bg-grey-600 btn-icon',
                text: '<i class="icon-file-excel"></i>'
            },
            {
                extend: 'colvis',
                text: '<i class="icon-grid7" data-popup="tooltip" title="Mostrar/Ocultar colunas" data-placement="top"></i> <span class="caret"></span>',
                className: 'btn bg-grey-800 btn-icon'
            }
        ],
        language: {
            buttons: {
                copyTitle: '<b>Copiando tabela</b>',
                copySuccess: {
                    _: 'Foram copiadas <b>%d linhas</b>',
                    1: '1 linha foi copiada'
                }
            },
            emptyTable: "Não há dados para mostrar..."
        },
        keys: true
    });

    $(".dataTables_paginate").removeClass("paging_simple_numbers").addClass('pagination pagination-flat pagination-rounded');
    $('.dataTables_filter input[type=search]').attr('placeholder', 'Pesquisar...');
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
};

$(function () {

    $("body").tooltip({container: 'body'});

    $('#empresa_id').select2({
        placeholder: 'Selecione uma empresa...'
    });

    $('#categoria_id').select2({
        placeholder: 'Selecione uma categoria...'
    });

    $('#tipo_ind_id').select2({
        placeholder: 'Selecione o tipo de indicador...'
    });

    $('#ano_id').select2({
        placeholder: 'Selecione o ano...'
    });

    $('#mes_id').select2({
        placeholder: 'Selecione o mês...'
    });

    $('#indicador_id').select2({
        placeholder: 'Selecione um indicador...'
    });

    $('#regional_id').select2({
        placeholder: 'Selecione uma regional...'
    });

    $('#distrital_id').select2({
        placeholder: 'Selecione uma distrital...'
    });

    $('#unidade').select2({
        placeholder: 'Selecione uma unidade...'
    });

    // Hide navbar with Headroom.js library
    $(".navbar-fixed-top").headroom({
        classes: {
            pinned: "headroom-top-pinned",
            unpinned: "headroom-top-unpinned"
        },
        offset: $('.navbar').outerHeight(),

        // callback when unpinned, `this` is headroom object
        onUnpin: function () {
            $('.navbar .dropdown-menu').parent().removeClass('open');
        }
    });

    dtpadrao();

});

function msgNotificacao(tipo, titulo, msg) {
    swal({
        title: titulo,
        text: msg,
        html: true,
        confirmButtonColor: "#66BB6A",
        type: tipo,
        timer: 2000
    });
}

temaPadrao = function() {

    var padrao = {
        // 默认色板
        color: [
            '#003862','#C30A12','#025159','#ffb980','#d87a80',
            '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
            '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
            '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
        ],

        // 图表标题
        title: {
            textStyle: {
                fontWeight: 'normal',
                fontSize: 17,
                color: '#008acd'          // 主标题文字颜色
            }
        },

        // 值域
        dataRange: {
            itemWidth: 15,
            color: ['#5ab1ef','#e0ffff']
        },

        // Tools
        toolbox: {
            /*
            color : ['#000000', '#1e90ff', '#1e90ff', '#1e90ff'],
            effectiveColor : '#ff4500',
            feature : {
                mark : {
                    title : {
                        mark : 'Markline switch',
                        markUndo : 'Undo markline',
                        markClear : 'Clear markline'
                    }
                }
            }
            */
        },


        animationDuration: 1000,

        legend: {
            itemGap: 15
        },

        // 提示框
        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.8)',     // 提示背景颜色，默认为透明度为0.7的黑色
            padding: [8, 12, 8, 12],
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'line',         // 默认为直线，可选为：'line' | 'shadow'
                lineStyle : {          // 直线指示器样式设置
                    color: '#607D8B',
                    width: 1
                },
                crossStyle: {
                    color: '#607D8B'
                },
                shadowStyle : {                     // 阴影指示器样式设置
                    color: 'rgba(200,200,200,0.2)'
                }
            },
            textStyle: {
                fontFamily: 'Roboto, sans-serif'
            }
        },

        // 区域缩放控制器
        dataZoom: {
            dataBackgroundColor: '#eceff1',
            fillerColor: 'rgba(96,125,139,0.1)',   // 填充颜色
            handleColor: '#607D8B',
            handleSize: 10
        },

        // 网格
        grid: {
            borderColor: '#eee'
        },

        // 类目轴
        categoryAxis: {
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: '#999',
                    width: 1
                }
            },
            splitLine: {           // 分隔线
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: ['#eee']
                }
            },
            nameTextStyle: {
                fontFamily: 'Roboto, sans-serif'
            },
            axisLabel: {
                textStyle: {
                    fontFamily: 'Roboto, sans-serif'
                }
            }
        },

        // 数值型坐标轴默认参数
        valueAxis: {
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: '#999',
                    width: 1
                }
            },
            splitArea : {
                show : true,
                areaStyle : {
                    color: ['rgba(250,250,250,0.1)','rgba(200,200,200,0.1)']
                }
            },
            splitLine: {           // 分隔线
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: ['#eee']
                }
            },
            nameTextStyle: {
                fontFamily: 'Roboto, sans-serif'
            },
            axisLabel: {
                textStyle: {
                    fontFamily: 'Roboto, sans-serif'
                }
            }
        },

        polar : {
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: '#ddd'
                }
            },
            splitArea : {
                show : true,
                areaStyle : {
                    color: ['rgba(250,250,250,0.2)','rgba(200,200,200,0.2)']
                }
            },
            splitLine : {
                lineStyle : {
                    color : '#ddd'
                }
            }
        },

        timeline : {
            lineStyle : {
                color : '#008acd'
            },
            controlStyle : {
                normal : { color : '#008acd'},
                emphasis : { color : '#008acd'}
            },
            symbol : 'emptyCircle',
            symbolSize : 3
        },

        // 柱形图默认参数
        bar: {
            itemStyle: {
                normal: {
                    barBorderRadius: 0
                },
                emphasis: {
                    barBorderRadius: 0
                }
            }
        },


        // Pies
        pie: {
            itemStyle: {
                normal: {
                    borderWidth: 1,
                    borderColor: '#fff'
                },
                emphasis: {
                    borderWidth: 1,
                    borderColor: '#fff'
                }
            }
        },


        // Default line
        line: {
            smooth : true,
            symbol: 'emptyCircle',  // Symbol type
            symbolSize: 3           // Circle dot size
        },

        // K线图默认参数
        k: {
            itemStyle: {
                normal: {
                    color: '#d87a80',       // 阳线填充颜色
                    color0: '#2ec7c9',      // 阴线填充颜色
                    lineStyle: {
                        color: '#d87a80',   // 阳线边框颜色
                        color0: '#2ec7c9'   // 阴线边框颜色
                    }
                }
            }
        },

        // 散点图默认参数
        scatter: {
            symbol: 'circle',    // 图形类型
            symbolSize: 4        // 图形大小，半宽（半径）参数，当图形为方向或菱形则总宽度为symbolSize * 2
        },

        // 雷达图默认参数
        radar : {
            symbol: 'emptyCircle',    // 图形类型
            symbolSize:3
            //symbol: null,         // 拐点图形类型
            //symbolRotate : null,  // 图形旋转控制
        },

        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#d87a80'
                        }
                    }
                },
                emphasis: {                 // 也是选中样式
                    areaStyle: {
                        color: '#fe994e'
                    }
                }
            }
        },

        force : {
            itemStyle: {
                normal: {
                    linkStyle : {
                        color : '#1e90ff'
                    }
                }
            }
        },

        chord : {
            itemStyle : {
                normal : {
                    borderWidth: 1,
                    borderColor: 'rgba(128, 128, 128, 0.5)',
                    chordStyle : {
                        lineStyle : {
                            color : 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis : {
                    borderWidth: 1,
                    borderColor: 'rgba(128, 128, 128, 0.5)',
                    chordStyle : {
                        lineStyle : {
                            color : 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },

        gauge : {
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: [[0.2, '#2ec7c9'],[0.8, '#5ab1ef'],[1, '#d87a80']],
                    width: 10
                }
            },
            axisTick: {            // 坐标轴小标记
                splitNumber: 10,   // 每份split细分多少段
                length :15,        // 属性length控制线长
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: {           // 分隔线
                length :22,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            pointer : {
                width : 5
            }
        },

        textStyle: {
            fontFamily: 'Roboto, Arial, Verdana, sans-serif'
        }
    };

    return padrao;
};