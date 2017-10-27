

<ul class="nav nav-pills pull-right">
    <li @if (Request::is('formx-demo/form*')) class="active"@endif>{!! link_to("formx-demo/form", "DataForm") !!}</li>
    <li @if (Request::is('formx-demo/advancedform*')) class="active"@endif>{!! link_to("formx-demo/advancedform", "Advanced stuffs") !!}</li>
    <li @if (Request::is('formx-demo/styledform*')) class="active"@endif>{!! link_to("formx-demo/styledform", "Custom view") !!}</li>
</ul>
