

{!! $dg->open !!}
<div class="datatree-inner-wrapper">
    <?php $rows = $dg->rows ?>
    @if ($rows)
        @include('formx::datatree.item')
    @else
        <div class="datatree-empty">
            No items
        </div>
    @endif
</div>
<div class="datatree-values"></div>
    @include('formx::toolbar', array('label'=>$label, 'buttons_right'=>$buttons['BR'], 'buttons_left'=>$buttons['BL']))

{!! $dg->close !!}
