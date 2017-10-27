@extends('formx::demo.master')

@section('title','Models')

@section('body')
    <h1>Models Used</h1>


    <p>
        These are the entities used in this demo:
        <br />

    </p>

    {!! Documenter::showCode("zofe/formx/src/Demo/Article.php") !!}
    {!! Documenter::showCode("zofe/formx/src/Demo/ArticleDetail.php") !!}
    {!! Documenter::showCode("zofe/formx/src/Demo/Author.php") !!}
    {!! Documenter::showCode("zofe/formx/src/Demo/Category.php") !!}
    {!! Documenter::showCode("zofe/formx/src/Demo/Comment.php") !!}

@stop


@section('content')

    @include('formx::demo.menu')

    @yield('body')

@stop
