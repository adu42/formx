
<nav class="navbar main">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse main-collapse">
        <ul class="nav nav-tabs">
            <li>{!! link_to("/", "Home", 'target="_blank"') !!}</li>
            <li @if (Request::is('formx-demo')) class="active"@endif>{!! link_to("formx-demo", "Index") !!}</li>
            <li @if (Request::is('formx-demo/models')) class="active"@endif>{!! link_to("formx-demo/models", "Models") !!}</li>
            <li @if (Request::is('formx-demo/set*')) class="active"@endif>{!! link_to("formx-demo/set", "DataSet") !!}</li>
            <li @if (Request::is('formx-demo/grid*')) class="active"@endif>{!! link_to("formx-demo/grid", "DataGrid") !!}</li>
            <li @if (Request::is('formx-demo/filter*', 'formx-demo/customfilter*')) class="active"@endif>{!! link_to("formx-demo/filter", "DataFilter") !!}</li>
            <li @if (Request::is('formx-demo/form*','formx-demo/advancedform*','formx-demo/styledform*')) class="active"@endif>{!! link_to("formx-demo/form", "DataForm") !!}</li>
            <li @if (Request::is('formx-demo/edit*')) class="active"@endif>{!! link_to("formx-demo/edit", "DataEdit") !!}</li>
            <li @if (Request::is('formx-demo/embed*')) class="active"@endif>{!! link_to("formx-demo/embed", "DataEmbed") !!}</li>
            <li @if (Request::is('formx-demo/datatree*')) class="active"@endif>{!! link_to("formx-demo/datatree", "DataTree") !!}</li>
        </ul>
    </div>
</nav>
