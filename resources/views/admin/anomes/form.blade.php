<form id="frmAnoMes" class="form-horizontal">
    {{ csrf_field() }}
    <input type="hidden" name="id_anomes"/>
    <div class="modal-body">
        <div class="form-group">
            <label for="ano_id" class="control-label col-sm-3">Ano</label>
            <div class="col-sm-9">
                {!! Form::select('ano_id', $anos, null,
                                            [
                                                'id'                => 'ano_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'      => 'Selecione um ano...'
                                            ])
                !!}
            </div>
        </div>
        <div class="form-group">
            <label for="mes_id" class="control-label col-sm-3">Mês</label>
            <div class="col-sm-9">
                {!! Form::select('mes_id', $meses, null,
                                            [
                                                'id'                => 'mes_id',
                                                'class'             => 'form-control select2',
                                                'placeholder'       => 'Selecione o mês...'
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