<form id="frmIndicador" class="form-horizontal">
    {{ csrf_field() }}
    <input type="hidden" name="id_indicador"/>
    <div class="modal-body">
        <div class="form-group">
            <label for="indicador" class="control-label col-sm-3">Nome</label>
            <div class="col-sm-9">
                <input id="indicador" name="indicador" type="text" placeholder="Nome do Indicador"
                       class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="categoria_id" class="control-label col-sm-3">Categoria</label>
            <div class="col-sm-9">
                {!! Form::select('categoria_id', $categorias, null,
                                            [
                                                'id'                => 'categoria_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'      => 'Selecione uma categoria...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="tipo_id" class="control-label col-sm-3">Tipo</label>
            <div class="col-sm-9">
                {!! Form::select('tipo_ind_id', $tipos, null,
                                            [
                                                'id'                => 'tipo_ind_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'       => 'Selecione o tipo de indicador...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="ordem" class="control-label col-sm-3">Ordem</label>
            <div class="col-sm-9">
                {!! Form::number('ordem', 0, [
                                                'id'                => 'ordem',
                                                'class'             => 'form-control',
                                                'placeholder'       => 'Informe a ordem...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="ordem" class="control-label col-sm-3">Ordem</label>
            <div class="col-sm-9">
                {!! Form::textarea('objetivo', null, [
                                                'id'                => 'objetivo',
                                                'class'             => 'form-control',
                                                'placeholder'       => 'Informe o objetivo do indicador...'
                                            ])
                !!}
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
