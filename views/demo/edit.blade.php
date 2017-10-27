@extends('formx::demo.demo')

@section('title','DataEdit')

@section('body')

    <h1>DataEdit</h1>
    <p>

        {!! $edit !!}
        {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "anyEdit") !!}
        {!! Documenter::showCode("zofe/formx/views/demo/edit.blade.php") !!}
    </p>
@stop
