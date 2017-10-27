

@if (in_array("show", $actions))
    <a class="" title="@lang('formx::formx.show')" href="{!! $uri !!}?show={!! $id !!}"><span class="glyphicon glyphicon-eye-open"> </span></a>
@endif
@if (in_array("modify", $actions))
    <a class="" title="@lang('formx::formx.modify')" href="{!! $uri !!}?modify={!! $id !!}"><span class="glyphicon glyphicon-edit"> </span></a>
@endif
@if (in_array("delete", $actions))
    <a class="text-danger" title="@lang('formx::formx.delete')" href="{!! $uri !!}?delete={!! $id !!}"><span class="glyphicon glyphicon-trash"> </span></a>
@endif
@if (in_array("more", $actions))
    <a class="" title="@lang('formx::formx.more')" href="{!! $uri !!}?more={!! $id !!}"><span class="glyphicon glyphicon-list-alt"> </span></a>
@endif
