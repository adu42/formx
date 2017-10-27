@extends('formx::demo.demo')

@section('title','DataGrid')

@section('body')

    <h1>DataGrid</h1>
    <p>

        {!! $grid !!}
        {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getGrid") !!}
        {!! Documenter::showCode("zofe/formx/views/demo/grid.blade.php") !!}
    </p>
@stop
