
<div class="rpd-dataform inline">
    @section('df.header')
        {!! $df->open !!}
        @include('formx::toolbar', array('label'=>$df->label, 'buttons_right'=>$df->button_container['TR']))
    @show
    
    @if ($df->message != '')
    @section('df.message')
        <div class="alert alert-success">{!! $df->message !!}</div>
    @show
    @endif
    
    @if ($df->message == '')
    @section('df.fields')
    
            @each('formx::dataform.field_inline', $df->fields, 'field')
    
    @show
    @endif
    
    @section('df.footer')
    
        @if (isset($df->button_container['BL']) && count($df->button_container['BL']))
    
            @foreach ($df->button_container['BL'] as $button) {!! $button !!}
            @endforeach
    
            @if($df->addlink)
                    <a href="{!! $df->addlink !!}" class="btn">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
            @endif
        @endif
    
        {!! $df->close !!}
    @show
</div>