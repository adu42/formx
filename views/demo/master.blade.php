<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Formx crud widgets for laravel 4')</title>
    <meta name="description" content="@yield('description', 'crud widgets for laravel 4. datatable, grids, forms, in a simple package')" />
    @section('meta', '')

    <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
    {!! Formx::styles(true) !!}
</head>
<?php $is_formx = (Request::server('HTTP_HOST') == "www.formx.com") ? true : false; ?>

<body>


<div id="wrap">

    <div class="container">

        <br />

        <div class="row">


            <div class="col-sm-12">
                @yield('content')
            </div>

            @if (isset($is_formx) AND $is_formx)

                <br />
                <br />
                <div id="disqus_thread"></div>


            @endif
        </div>


    </div>



</div>

<div id="footer">
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/riot/2.2.4/riot+compiler.min.js"></script>
{!! Formx::scripts() !!}
<script>riot.mount('*')</script>

@if (isset($is_formx) AND $is_formx)
    
    <div class="privacy-overlay">
        <div class="privacy-modal"></div>
    </div>
    <link href="/css/policy.css" rel="stylesheet">
    <script src="/js/policy.js"></script>
@endif
</body>
</html>
