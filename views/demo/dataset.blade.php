@extends('formx::demo.demo')

@section('title','DataSet')

@section('body')

<h1>DataSet</h1>

<p>

    @foreach ($dataset->data as $item) {!! $item['nome'] !!}<br />
    @endforeach
    <br />
    {!! $dataset->links() !!}
    <br />
    <a href="{!! $dataset->orderbyLink('nome', 'desc') !!}">sort a-z</a>  |  <a href="{!! $dataset->orderbyLink('nome', 'asc') !!}">sort z-a</a>

    {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getSet") !!}
    {!! Documentor::showCode("zofe/formx/views/formx/dataset.blade.php") !!}
</p>
@stop
