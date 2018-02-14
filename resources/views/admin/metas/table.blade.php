@foreach($dados as $dado)
    <tr id="linha-{{ $dado->id }}">
        <td>{{ $dado->id }}</td>
        <td name="{{ $dado->indicador_id }}">{{ $dado->indicador->indicador }}</td>
        <td name="{{ $dado->empresa_id }}">{{ $dado->empresa->empresa }}</td>
        <td name="{{ $dado->regional_id }}">@if($dado->regional_id) {{ $dado->regional->regional }} @endif</td>
        <td name="@if($dado->distrital_id) {{ $dado->distrital_id }} @endif">@if($dado->distrital_id) {{ $dado->distrital->distrital }} @endif</td>
        <td name="{{ $dado->unidade }}">{{ $dado->getUnidade() }}</td>
        <td class="col-sm-3">
            <ul class="icons-list">
                <li class="text-primary-600"><a id="{{ $dado->id }}" class="btnEdit" href="#" data-popup="tooltip" title="Alterar"><i class="icon-pencil7"></i></a></li>
                <li class="text-danger-600"><a name="{{ $dado->id }}" class="btnDelete" href="#" data-popup="tooltip" title="Remover"><i class="icon-trash"></i></a></li>
            </ul>
        </td>
        {{--<td class="text-center">--}}
        {{--<a class="btnEdit" id="{{ $dado->id }}"--}}
        {{--style="margin-right: 5px;" href="#" data-popup="tooltip" title="Alterar"><i--}}
        {{--class="icon-pencil"></i> </a>--}}
        {{--<a name="{{ $dado->id }}" class="text-danger-700 btnDelete" href="#" data-popup="tooltip"--}}
        {{--title="Remover"><i class="icon-trash"></i></a>--}}
        {{--</td>--}}
    </tr>
@endforeach
