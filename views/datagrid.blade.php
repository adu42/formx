

<div class="rpd-datagrid">
@if ($dg->getUpdataFiled('html'))
    {!! $dg->getUpdataFiled('formOpen') !!}
    @include('formx::toolbar', array('label'=>$label, 'buttons_right'=>$buttons['TR'],'html'=>$dg->getUpdataFiled('html'),'other'=>$dg->getUpdataFiled('other')))
@else
    @include('formx::toolbar', array('label'=>$label, 'buttons_right'=>$buttons['TR']))
@endif
    <div class="table-responsive">
        <table{!! $dg->buildAttributes() !!}>
            <thead>
            <tr>
                @foreach ($dg->columns as $column)
                    <th{!! $column->buildAttributes() !!}>
                        @if ($column->orderby)
                            @if ($dg->onOrderby($column->orderby_field, 'asc'))
                                <span class="glyphicon glyphicon-chevron-up"></span>
                            @else
                                <a href="{{ $dg->orderbyLink($column->orderby_field,'asc') }}">
                                    <span class="glyphicon glyphicon-chevron-up"></span>
                                </a>
                            @endif
                            @if ($dg->onOrderby($column->orderby_field, 'desc'))
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            @else
                                <a href="{{ $dg->orderbyLink($column->orderby_field,'desc') }}">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                            @endif
                        @endif
                        {!! $column->label !!}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @if (count($dg->rows) == 0)
                <tr><td colspan="{!! count($dg->columns) !!}">{!! trans('formx::formx.no_records') !!}</td></tr>
            @endif
            @foreach ($dg->rows as $row)
                <tr{!! $row->buildAttributes() !!}>
                    @foreach ($row->cells as $cell)
                        <td{!! $cell->buildAttributes() !!}>{!! $cell->value !!}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
@if ($dg->getUpdataFiled('html'))
    @include('formx::toolbar', array('buttons_left'=>$buttons['BL'],'buttons_right'=>$buttons['BR'],'html'=>$dg->getUpdataFiled('html'),'other'=>$dg->getUpdataFiled('other')))
    {!! $dg->getUpdataFiled('formClose') !!}
@endif
    </div>

    <div class="btn-toolbar" role="toolbar">
        @if ($dg->havePagination())
            <div class="pull-left">
                {!! $dg->links() !!}
            </div>
            <div class="pull-right rpd-total-rows">
                {!! $dg->totalRows() !!}
            </div>
        @endif
    </div>
</div>

