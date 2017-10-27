@extends('formx::demo.demo')

@section('title','DataTree')

@section('body')

    <h1>DataTree</h1>
        {!! $tree !!}
    <p>

        {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "anyDatatree") !!}
        {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "anyMenuedit") !!}
        {!! Documenter::showCode("zofe/formx/views/demo/tree.blade.php") !!}
    </p>
@stop
