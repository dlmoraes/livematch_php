<form id="frmMeta" class="form-horizontal">
    {{ csrf_field() }}
    <input type="hidden" name="id_meta"/>
    <div class="modal-body">
        <div class="form-group">
            <label for="empresa_id" class="control-label col-sm-3">Empresa</label>
            <div class="col-sm-9">
                {!! Form::select('empresa_id', $empresas, null,
                                            [
                                                'id'                => 'empresa_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'      => 'Selecione uma empresa...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="indicador_id" class="control-label col-sm-3">Indicador</label>
            <div class="col-sm-9">
                {!! Form::select('indicador_id', $indicadores, null,
                                            [
                                                'id'                => 'indicador_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'       => 'Selecione um indicador...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="regional_id" class="control-label col-sm-3">Regional</label>
            <div class="col-sm-9">
                {!! Form::select('regional_id', $regionais, null,
                                            [
                                                'id'                => 'regional_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'       => 'Selecione uma regional...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="distrital_id" class="control-label col-sm-3">Distrital</label>
            <div class="col-sm-9">
                {!! Form::select('distrital_id', $distritais, null,
                                            [
                                                'id'                => 'distrital_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'       => 'Selecione uma distrital...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="unidade" class="control-label col-sm-3">Unidade</label>
            <div class="col-sm-9">
                {!! Form::select('unidade', $unidades, null,
                                            [
                                                'id'                => 'unidade',
                                                'class'             => 'form-control select2',
                                                'placeholder'       => 'Selecione uma unidade...'
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
