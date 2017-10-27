@extends('formx::demo.demo')

@section('title','DataFilter')

@section('body')

    @include('formx::demo.menu_filter')

    <h1>DataFilter</h1>

    <p>
        {!! $filter !!}
        {!! $grid !!}
        {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getFilter") !!}
        {!! Documenter::showCode("zofe/formx/views/demo/filtergrid.blade.php") !!}
    </p>

@stop
