@extends('formx::demo.master')

@section('title','Demo')


@section('body')
    
    
    <h1>Demo Index</h1>

    @if(Session::has('message'))
    <div class="alert alert-success">
        {!! Session::get('message') !!}
    </div>
    @endif

    <p>
        Welcome to Formx Demo.<br />

        @if (isset($is_formx) AND $is_formx)

        @else
            first click on Populate Database button, then click on menu<br />
            <br />
            {!! link_to('formx-demo/schema', "Populate Database", array("class"=>"btn btn-default")) !!}
        @endif

        <br />
        <br />
        Click on tabs to see how formx widgets can save your time.<br />
        The first tab <strong>Models</strong> is included just to show  models and relations used in this demo,
        there isn't custom code, formx can work with your standard or extended Eloquent models.
        <strong>DataSet</strong>, <strong>DataGrid</strong>, <strong>DataFilter</strong>,
        <strong>DataForm</strong>, and <strong>DataEdit</strong> are the "widgets" that formx provide.

    </p>


@stop


@section('content')

    @include('formx::demo.menu')

    @yield('body')




@stop
