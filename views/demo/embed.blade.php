@extends('formx::demo.demo')

@section('title','DataEmbed')

@section('body')

    

    
    <h1>DataEmbed</h1>

    DataEmbed can embed a url and then isolate it in the dom.<br />
    So you can build multiple widgets in page, and all actions will be execued without page reload<br />  
    
    Scenarios (where you cant reload the page): 
    <ul>
        <li>a form in a bootstrap modal</li>
        <li>a login-form in a cached page</li>
        <li>a comment widget in a static page</li>
    </ul>
    You have only to give the endpoint url and an id, then it will be loded and will work isolated in the dom.<br />
    <br />

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                
                {!! $embed1 !!}
            </div>

            <div class="col-sm-6">

                {!! $embed2 !!}
            </div>
        </div>
    </div>

    Requirements are jquery, riotjs, pjax in your master layout:
    <pre>
    <code>
        <?php echo htmlentities('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/riot/2.2.4/riot+compiler.min.js"></script>
        {!! Formx::scripts() !!}
        <script>riot.mount("*")</script>
        ..
      </body>');?>
    </code>
    </pre>

    {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getEmbed") !!}
    {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "getNudegrid") !!}
    {!! Documenter::showMethod("Ado\\Formx\\Demo\\DemoController", "anyNudeedit") !!}
    {!! Documenter::showCode("zofe/formx/views/demo/embed.blade.php") !!}

@stop
