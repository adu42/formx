

<ul class="nav nav-pills pull-right">
    <li @if (Request::is('formx-demo/filter*')) class="active"@endif>{!! link_to("formx-demo/filter", "DataFilter") !!}</li>
    <li @if (Request::is('formx-demo/customfilter*')) class="active"@endif>{!! link_to("formx-demo/customfilter", "Customizations") !!}</li>
</ul>
