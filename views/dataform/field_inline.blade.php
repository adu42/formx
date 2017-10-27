@if ($field->type == 'hidden')

    {!! $field->output !!}

    @if ($field->message!='')
        <span class="help-block">
            <span class="glyphicon glyphicon-warning-sign"></span>
            {!! $field->message !!}
        </span>
    @endif
@elseif (in_array($field->type, array('checkbox','radio')))
    <div class="{!! $field->type !!} clearfix{!!$field->has_error!!}" id="fg_{!! $field->name !!}">
        <label for="{!! $field->name !!}" class="col-sm-offset-3 col-sm-10 {!! $field->req !!}">{!! $field->output !!}{!! $field->label !!}</label>
        @if(count($field->messages))
            @foreach ($field->messages as $message)
                <span class="help-block">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                    {!! $message !!}
                    </span>
            @endforeach
        @endif
    </div>
@else
    <div class="form-group{!!$field->has_error!!}" id="fg_{!! $field->name !!}">

        <label for="{!! $field->name !!}" class="sr-only">{!! $field->label.$field->star !!}</label>
        <span id="div_{!! $field->name !!}">

            {!! $field->output !!}


            @if(count($field->messages))
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @endif

        </span>

    </div>
@endif
