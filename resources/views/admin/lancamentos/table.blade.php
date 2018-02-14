@foreach($dados as $dado)
    <tr id="linha-{{ $dado->id }}">
        <td>{{ $dado->id }}</td>
        <td name="{{ $dado->meta_id }}">{{ $dado->indicador }}</td>
        <td>{{ $meta->txtUnidade($dado->unidade) }}</td>
        <td data-ano="{{ $dado->ano_id }}" data-mes="{{ $dado->mes_id }}">{{ $dado->mes }}/{{ $dado->ano }}</td>
        <td>{{ $dado->vlr_meta }}</td>
        <td>{{ $dado->vlr_real }}</td>
        <td>
            <span class="label label-info label-block">
                @if ($dado->distrital)
                        Distrital
                @elseif($dado->regional)
                        Regional
                @else
                        Empresa
                @endif
            </span>
        </td>
        <td>{{ $dado->empresa }}</td>
        <td>{{ $dado->regional }}</td>
        <td>{{ $dado->distrital }}</td>
        <td class="col-sm-1">
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
