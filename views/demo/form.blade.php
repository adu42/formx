@extends('formx::demo.demo')

@section('title','DataForm')

@section('body')

    @include('formx::demo.menu_form')

    <h1>DataForm</h1>
    <p>

        {!! $form !!}
        {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "anyForm") !!}
        {!! Documenter::showCode("zofe/formx/views/demo/form.blade.php") !!}
    </p>
@stop
